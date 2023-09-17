<?php

namespace app\modules\admin\controllers;

use yii\web\Controller;
use yii\filters\AccessControl;

/**
 * Default controller for the `admin` module
 */
class AdminAppController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['canAdmin'],
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


