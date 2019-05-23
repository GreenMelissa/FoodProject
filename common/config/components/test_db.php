<?php

/**
 * Database configuration.
 * You can choose between preconfigured db components (mysql, pgsql) by changing value of DB_DRIVER
 * env property in your .env file.
 * @see
 */

use yii\db\pgsql\ColumnSchema;
use yii\db\pgsql\Schema;
use yii\helpers\ArrayHelper;

$defaults = [
    'class' => 'yii\db\Connection',
    'enableSchemaCache' => env('DB_SCHEMA_CACHE_ENABLED', false),
    'schemaCacheDuration' => env('DB_SCHEMA_CACHE_DURATION', 3600),
    'enableQueryCache' => env('DB_QUERY_CACHE_ENABLED', true),
    'queryCacheDuration' => env('DB_QUERY_CACHE_DURATION', 3600),
    'username' => env('DB_USER'),
    'password' => env('DB_PASS'),
    'schemaMap' => [
        'pgsql' => [
            'class' => Schema::class,
            'columnSchemaClass' => [
                'class' => ColumnSchema::class,
                'deserializeArrayColumnToArrayExpression' => false,
            ],
        ],
    ],
];

$drivers = [
    'pgsql' => [
        'dsn' => 'pgsql:host=' . env('DB_HOST', 'localhost') . ';port=' . env('DB_PORT', '5432') . ';dbname=' . env('DB_NAME'),
    ],
];

return ArrayHelper::merge($defaults, $drivers['pgsql']);
