<?php

namespace app\modules\viewing\controllers;

use yii\web\Controller;
use yii\filters\AccessControl;

/**
 * Default controller for the `admin` module
 */
class ViewingAppController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['canViewMarksAndAttendance'],
                    ],
                    [
                        'denyCallback' => function ($rule, $action) {
                            $this->goHome();
                        }
                    ]
                ],
            ],
        ];
    }
}


