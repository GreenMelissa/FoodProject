<?php

use yii\helpers\ArrayHelper;
use yii\console\controllers\MigrateController;
use dektrium\rbac\RbacConsoleModule;
use console\controllers\AdminController;

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
        'admin' => AdminController::class,
        'migrate' => [
            'class' => MigrateController::class,
            'templateFile' => '@console/templates/migration.php',
            'migrationPath' => [
                '@dektrium/user/migrations',
                '@yii/rbac/migrations',
            ],
            'migrationNamespaces' => [
                'console\\migrations',
                'common\\modules\\user\\migrations',
                'frontend\\modules\\builder\\migrations',
            ],
        ],
    ],
    'modules' => [
        'rbac' => [
            'class' => RbacConsoleModule::class,
            'controllerMap' => [
                'migrate' => [
                    'class' => \dektrium\rbac\commands\MigrateController::class,
                    'migrationPath' => null,
                    'migrationNamespaces' => [
                        'console\\rbac\\migrations',
                        'frontend\\modules\\builder\\rbac',
                    ],
                ],
            ],
        ],
    ],
];

return ArrayHelper::merge(
    require(__DIR__ . '/../../common/config/main.php'),
    $config
);
