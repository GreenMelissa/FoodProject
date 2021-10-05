<?php

use dektrium\rbac\components\DbManager;

return [
    'id' => 'food-project',
    'basePath' => dirname(__DIR__),
    'language' => 'ru-RU',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => require(__DIR__ . '/components/cache.php'),
        'db' => require(__DIR__ . '/components/db.php'),
        'urlManager' => require(__DIR__ . '/components/url.php'),
        'log' => require(__DIR__ . '/components/log.php'),
        'i18n'         => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                ],
                'food*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                ],
            ],
        ],
    ],
];
