<?php

namespace app\modules\manage\controllers;

use Yii;
use app\models\Student;
use app\models\NewStudentSearch;
use app\models\User;
use app\models\Group;
use app\models\Department;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * StudentController implements the CRUD actions for Student model.
 */
class StudentController extends ManageAppController
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
     * Lists all Student models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new NewStudentSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Student model.
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
     * Creates a new Student model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Student();
        $studentList = User::getUserByRole('student');

        $myDepartment = null;

        $groupList = Group::getGroupListByDepartment();

        if (Yii::$app->user->identity->getRoles(Yii::$app->user->identity->id) ==  'Заведующий отделением') {
            $user_id = Yii::$app->user->id;
            $myDepartment = Department::getDepartmentByUserId($user_id);
        }

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['index']);
            }
        } 

        return $this->render('create', [
            'model' => $model,
            'studentList' => $studentList,
            'groupList' => $groupList,
            'myDepartment' => $myDepartment
        ]);
    }

    /**
     * Updates an existing Student model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $studentList = User::getUserByRole('student');

        $myDepartment = null;

        $groupList = Group::getGroupListByDepartment();

        if (Yii::$app->user->identity->getRoles(Yii::$app->user->identity->id) ==  'Заведующий отделением') {
            $user_id = Yii::$app->user->id;
            $myDepartment = Department::getDepartmentByUserId($user_id);
        }

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
            'studentList' => $studentList,
            'groupList' => $groupList,
            'myDepartment' => $myDepartment
        ]);
    }

    /**
     * Deletes an existing Student model.
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
     * Finds the Student model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Student the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Student::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
