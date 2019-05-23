<?php

use dektrium\rbac\components\DbManager;

return [
    'id' => 'app-common',
    'basePath' => dirname(__DIR__),
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => require(__DIR__ . '/components/cache.php'),
        'db' => require(__DIR__ . '/components/db.php'),
        'mailer' => require(__DIR__ . '/components/mailer.php'),
        'urlManager' => require(__DIR__ . '/components/url.php'),
        'log' => require(__DIR__ . '/components/log.php'),
        'authManager' => [
            'class' => DbManager::class,
        ],
        'i18n'         => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                ],
                'user*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                ],
            ],
        ],
    ],
    'params' => [
        'adminEmail' => 'admin@example.com',
        'supportEmail' => 'support@example.com',
        'user.passwordResetTokenExpire' => 3600,
    ],
];
