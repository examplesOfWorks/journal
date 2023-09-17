<?php

namespace app\modules\manage\controllers;

use Yii;
use app\models\Group;
use app\models\NewGroupSearch;
use app\models\Specialty;
use app\models\Department;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * GroupController implements the CRUD actions for Group model.
 */
class GroupController extends ManageAppController
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
     * Lists all Group models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new NewGroupSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $myDepartment = null;

        if (Yii::$app->user->identity->getRoles(Yii::$app->user->identity->id) ==  'Заведующий отделением') {
            $user_id = Yii::$app->user->id;
            $myDepartment = Department::getDepartmentByUserId($user_id);
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'myDepartment' => $myDepartment
        ]);
    }

    /**
     * Displays a single Group model.
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
     * Creates a new Group model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Group();
        $specialtyList = Specialty::getSpecialtyList();

        $myDepartment = null;

        if (Yii::$app->user->identity->getRoles(Yii::$app->user->identity->id) ==  'Заведующий отделением') {
            $user_id = Yii::$app->user->id;
            $myDepartment = Department::getDepartmentByUserId($user_id);
        }

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                Yii::$app->session->setFlash('success', "Новая группа успешно добавлена.");
                return $this->redirect(['index']);
            }
        } /*else {
            $model->loadDefaultValues();
        }*/

        return $this->render('create', [
            'model' => $model,
            'specialtyList' => $specialtyList,
            'myDepartment' => $myDepartment
        ]);
    }

    /**
     * Updates an existing Group model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $specialtyList = Specialty::getSpecialtyList();

        if (Yii::$app->user->identity->getRoles(Yii::$app->user->identity->id) ==  'Заведующий отделением') {
            $user_id = Yii::$app->user->id;
            $myDepartment = Department::getDepartmentByUserId($user_id);
        }

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
            'specialtyList' => $specialtyList,
            'myDepartment' => $myDepartment
        ]);
    }

    /**
     * Deletes an existing Group model.
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
     * Finds the Group model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Group the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Group::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
