<?php

use frontend\modules\food\FoodModule;
use frontend\modules\tag\TagModule;
use yii\helpers\ArrayHelper;

$config = [
    'id' => 'app-frontend',
    'name' => 'Food Project',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'modules' => [
        'food' => FoodModule::class,
        'tag' => TagModule::class,
    ],
    'components' => [
        'request' => [
            'cookieValidationKey' => env('COOKIE_VALIDATION_KEY'),
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => \yii\web\User::class,
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'assetManager' => [
            'linkAssets' => true,
        ],
    ],
];


if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return ArrayHelper::merge(
    require(__DIR__ . '/../../common/config/main.php'),
    $config
);

