<?php

namespace app\modules\teacher\controllers;

use app\models\SubjectName;
use Yii;
use app\models\Mark;
use app\models\MarkSearch;
use app\models\Student;
use app\models\Schedule;
use app\models\Group;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ArrayDataProvider;

/**
 * JournalController implements the CRUD actions for Mark model.
 */
class JournalController extends TeacherAppController
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
        // try {
            $teacher_id = Yii::$app->user->id;
            $subject_name_id = Yii::$app->request->get()['subject_name_id'];
            $group_id = Yii::$app->request->get()['group_id'];
            $studentsFromGroup = Student::getStudentsFormGroup($group_id);
    
            $searchModel = new MarkSearch();
            $dateList = Schedule::getDateList($teacher_id, $subject_name_id, $group_id);

            if (empty($dateList)) {
                $group_name = Group::getGroupById($group_id)[0];
                $subjectName = SubjectName::getSubjectNameById($subject_name_id)[0];
                return $this->render('index-empty', [
                    'searchModel' => $searchModel,
                    'subject_name_id' => $subject_name_id,
                    'group_id' => $group_id,
                    'group_name' => $group_name,
                    'subjectName' => $subjectName,
                ]);
            }
            
            $markList = Mark::getMarkList();
            $group_name = Group::getGroupById($group_id)[0];
            $subjectName = SubjectName::getSubjectNameById($subject_name_id)[0];
    
            $page = Yii::$app->request->get('page');
    
            $valueYear = Yii::$app->request->get()['year'];
    
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
    
            $thisMonth = date('M'); 
    
            $dataProviderMonth = new ArrayDataProvider(['allModels' => $monthsEng, 'pagination' => ['pageSize' => 1]]);
            $dataProviderYears = new ArrayDataProvider(['allModels' => $years, 'pagination' => ['pageSize' => 1]]);
           
            $datesNumber = Schedule::getDatesNumber($teacher_id, $subject_name_id, $group_id, $thisMonth);
    
            $modelMark = new Mark();
    
            $valuesMark = [
                0 => 1,
                1 => 2,
                2 => 3,
                3 => 4,
                4 => 5,
                5 => 'н',
                6 => 'ув.',
                7 => 'б',
            ];
    
            if ($this->request->isPost) {
    
                $modelMark = new Mark();
    
                if (isset($this->request->post()['Mark'])) {
                    if ($this->request->post()['Mark']['mark']!=null) {
                        if ($modelMark->load($this->request->post()) ) {
        
                            $mark = $valuesMark[$modelMark->mark];
                            
                                $modelMark->mark = (string)$mark;
        
                                $modelMark->save();
                                return $this->redirect(['index', 'subject_name_id' => $subject_name_id, 'group_id' => $group_id, 
                                'year' => Yii::$app->request->get()['year'], 'page' => $page]);
                
                            }   
                    }
                }
                
            }
    
    
            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProviderMonth' => $dataProviderMonth,
                'years' => $years,
                'valueYear' => $valueYear,
                'dateList' => $dateList,
                'markList' => $markList,
                'group_name' => $group_name,
                'subjectName' => $subjectName,
                'modelMark' => $modelMark,
                'studentsFromGroup' => $studentsFromGroup,
                'subject_name_id' => $subject_name_id,
                'datesNumber' => $datesNumber,
                'monthsTranslation' => $monthsTranslation,
                'group_id' => $group_id
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

        $subject_name_id = Yii::$app->request->get()['subject_name_id'];
        $group_id = Yii::$app->request->get()['group_id'];
        $year = Yii::$app->request->get()['year'];
        $page = Yii::$app->request->get()['page'];

        return $this->redirect(['index', 'subject_name_id' => $subject_name_id, 'group_id' => $group_id, 
        'year' => $year, 'page' => $page]);
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