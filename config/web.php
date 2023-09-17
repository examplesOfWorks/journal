<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    //'language' => 'ru-RU',
    'defaultRoute' => 'site/about',
    'modules' => [
        'admin' => [
            'class' => 'app\modules\admin\Module',
            'defaultRoute' => 'default/admin',
            'layout' => 'mainAdmin',
        ],
        'adding' => [
            'class' => 'app\modules\adding\Module',
        ],
        'manage' => [
            'class' => 'app\modules\manage\Module',
        ],
        'teacher' => [
            'class' => 'app\modules\teacher\Module',
        ],
        'viewing' => [
            'class' => 'app\modules\viewing\Module',
        ],
    ],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'hbkdsfgdfg',
            'baseUrl' => '',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => \yii\symfonymailer\Mailer::class,
            'useFileTransport' => false, // для отправки сообщений выставить false
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'scheme' => 'smtps',
                'host' => 'smtp.mail.ru',
                'username' => 'an.br1@mail.ru',
                'password' => '4rkvfb8ZjAjMezh8JBBv',
                'port' => '465',
                'options' => ['ssl' => true],

            ],            
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        
    ],
    'params' => $params,

];

 if (YII_ENV_DEV) {
     // configuration adjustments for 'dev' environment
     $config['bootstrap'][] = 'debug';
     $config['modules']['debug'] = [
         'class' => 'yii\debug\Module',
         // uncomment the following to add your IP if you are not connecting from localhost.
         'allowedIPs' => ['*'],
     ];

     $config['bootstrap'][] = 'gii';
     $config['modules']['gii'] = [
         'class' => 'yii\gii\Module',
         // uncomment the following to add your IP if you are not connecting from localhost.
         'allowedIPs' => ['*'],
     ];
 }

return $config;