<?php

use common\modules\user\models\User;
use dektrium\rbac\components\DbManager;

try {
    (new Dotenv\Dotenv(dirname(__DIR__) . '/../common/config'))->load();
} catch (Dotenv\Exception\InvalidPathException $e) {
}

return  [
    'id' => 'app-common-tests',
    'basePath' => dirname(__DIR__),
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'pgsql:host=' . env('DB_HOST', 'localhost') . ';port=' . env('DB_PORT', '5432') . ';dbname=' . env('TEST_DB_NAME'),
            'username' => 'postgres',
            'password' => 'postgres',
            'charset' => 'utf8',
        ],
        'user' => [
            'identityClass' => User::class,
        ],
        'authManager' => [
            'class' => DbManager::class,
        ],
        'request' => [
            'cookieValidationKey' => env('COOKIE_VALIDATION_KEY'),
            'csrfParam' => '_csrf-frontend',
        ],
    ],
];
