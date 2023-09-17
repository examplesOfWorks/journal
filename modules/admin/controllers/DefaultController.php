<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use app\models\OrganizationalInfoSearch;
use app\models\OrganizationalInfo;

/**
 * Default controller for the `admin` module
 */
class DefaultController extends AdminAppController
{

    public function actionIndex()
    {
        return $this->render('index');
    }


    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

}
