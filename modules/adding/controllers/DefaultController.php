<?php

namespace app\modules\adding\controllers;

use yii\web\Controller;

/**
 * Default controller for the `adding` module
 */
class DefaultController extends AddingAppController
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
