<?php

namespace app\modules\adding\controllers;

use yii\web\Controller;
use yii\filters\AccessControl;

/**
 * Default controller for the `admin` module
 */
class AddingAppController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['canAddInfo'],
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


