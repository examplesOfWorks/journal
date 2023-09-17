<?php

namespace app\modules\manage\controllers;

use Yii;
use app\models\SubjectUser;
use app\models\NewSubjectUserSearch;
use app\models\SubjectName;
use app\models\User;
use app\models\Department;
use app\models\Group;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\VarDumper;

/**
 * SubjectUserController implements the CRUD actions for SubjectUser model.
 */
class SubjectUserController extends ManageAppController
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
     * Lists all SubjectUser models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new NewSubjectUserSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SubjectUser model.
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
     * Creates a new SubjectUser model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new SubjectUser();
        $subjectNameList = SubjectName::getSubjectNameList();
        $teacher = User::getUserByRole('teacher');
        // $user_id = Yii::$app->user->id;
        // $myDepartment = Department::getDepartmentByUserId($user_id);
        $groupList = Group::getGroupListByDepartment();

        if ($this->request->isPost) {
            
            if ($model->load($this->request->post()) && $model->save()) {
                // VarDumper::dump($model->save(), 10, true); die;
                return $this->redirect(['index']);
            }
        } /*else {
            $model->loadDefaultValues();
        }*/

        return $this->render('create', [
            'model' => $model,
            'subjectNameList' => $subjectNameList,
            'teacher' => $teacher,
            'groupList' => $groupList
        ]);
    }

    /**
     * Updates an existing SubjectUser model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $subjectNameList = SubjectName::getSubjectNameList();
        $teacher = User::getUserByRole('teacher');
        $groupList = Group::getGroupListByDepartment();

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
            'subjectNameList' => $subjectNameList,
            'teacher' => $teacher,
            'groupList' => $groupList
        ]);
    }

    /**
     * Deletes an existing SubjectUser model.
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
     * Finds the SubjectUser model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return SubjectUser the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SubjectUser::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
