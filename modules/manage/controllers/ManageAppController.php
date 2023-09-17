<?php

namespace app\modules\manage\controllers;

use yii\web\Controller;
use yii\filters\AccessControl;

/**
 * Default controller for the `admin` module
 */
class ManageAppController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['canManageProcess'],
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


