<?php

use yii\helpers\ArrayHelper;
use yii\console\controllers\MigrateController;

$config = [
    'id' => 'app-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'console\controllers',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'controllerMap' => [
        'migrate' => [
            'class' => MigrateController::class,
            'templateFile' => '@console/templates/migration.php',
            'migrationPath' => null,
            'migrationNamespaces' => [
                'frontend\\modules\\food\\migrations',
            ],
        ],
    ],
];

return ArrayHelper::merge(
    require(__DIR__ . '/../../common/config/main.php'),
    $config
);
