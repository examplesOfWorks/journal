<?php

namespace app\modules\viewing\controllers;

use app\models\SubjectName;
use Yii;
use app\models\Mark;
use app\models\MarkViewSearch;
use app\models\Schedule;
use app\models\Group;
use app\models\Student;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ArrayDataProvider;
use yii\helpers\VarDumper;

/**
 * ViewMarksController implements the CRUD actions for Mark model.
 */
class ViewMarksController extends ViewingAppController
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::class,
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Mark models.
     *
     * @return string
     */
    public function actionIndex()
    {

        $thisRole = Yii::$app->user->identity->getRoles(Yii::$app->user->id);

        $searchModel = new MarkViewSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        $thisRole = Yii::$app->user->identity->getRoles(Yii::$app->user->id);
        $valueYear = Yii::$app->request->get()['year'];

        if ($thisRole == 'Студент') {
            $myGroupId = Group::getGroupByStudentId(Yii::$app->user->id)[0]['id'];
            $subject_name_id = Yii::$app->request->get()['subject_name_id'];
            $subjectName = SubjectName::getSubjectNameById($subject_name_id)[0];
            $dateList = Schedule::getDateListViewing($subject_name_id, $myGroupId);
            $student_id = Student::getStudentByUserId(Yii::$app->user->id);
        } else {
            $myGroupId = Group::getGroupByStudentId(Yii::$app->request->get()['student_id'])[0]['id'];
            $subject_name_id = Yii::$app->request->get()['subject_name_id'];
            $subjectName = SubjectName::getSubjectNameById($subject_name_id)[0];
            $dateList = Schedule::getDateListViewing($subject_name_id, $myGroupId);
            $student_id = Student::getStudentByUserId(Yii::$app->request->get()['student_id']);
        }

        $thisStudent = Student::getThisStudent($student_id);

        if (empty($dateList)) {
            return $this->render('index-empty', [
                'subjectName' => $subjectName,
                'thisRole' => $thisRole,
                'subject_name_id' => $subject_name_id,
                'thisRole' => $thisRole
            ]);
        }

        foreach ($dateList as $date) {
            if (\Yii::$app->formatter->asDate($date['date'], 'php:Y') == $valueYear) {
                $monthsList[] = \Yii::$app->formatter->asDate($date['date'], 'php:F Y');  
            }  
            $yearsList[] = \Yii::$app->formatter->asDate($date['date'], 'php:Y'); 
        }
        $monthsEng = array_unique($monthsList);
        $years = array_unique($yearsList);

        $monthsTranslation = [
            'January' => 'Январь',
            'February' => 'Февраль',
            'March' => 'Март',
            'April' => 'Апрель',
            'May' => 'Май',
            'June' => 'Июнь',
            'July' => 'Июль',
            'August' => 'Август',
            'September' => 'Сентябрь',
            'October' => 'Октябрь',
            'November' => 'Ноябрь',
            'December' => 'Декабрь',
        ];

        $valueYear = Yii::$app->request->get()['year'];

        $thisMonth = date('M'); 
        $dataProviderMonth = new ArrayDataProvider(['allModels' => $monthsEng, 'pagination' => ['pageSize' => 1]]);
        $dataProviderStudent = new ArrayDataProvider(['allModels' => $thisStudent, 'pagination' => false]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'dateList' => $dateList,
            'dataProviderMonth' => $dataProviderMonth,
            'thisStudent' => $thisStudent,
            'dataProviderStudent' => $dataProviderStudent,
            'subjectName' => $subjectName,
            'thisRole' => $thisRole,
            'valueYear' => $valueYear,
            'years' => $years,
            'subject_name_id' => $subject_name_id,
            'monthsTranslation' => $monthsTranslation,
            'thisRole' => $thisRole
        ]);
    }

    /**
     * Displays a single Mark model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Mark model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Mark();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Mark model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Mark model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Mark model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Mark the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Mark::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
