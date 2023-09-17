<?php

namespace app\modules\teacher\controllers;

use yii\web\Controller;
use yii\filters\AccessControl;

/**
 * Default controller for the `admin` module
 */
class TeacherAppController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['canTeaching'],
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


