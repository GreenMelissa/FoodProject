<?php

use frontend\FrontendApplication;

require(dirname(__DIR__) . '/../vendor/autoload.php');

try {
    (new Dotenv\Dotenv(dirname(__DIR__) . '/../common/config'))->load();
} catch (Dotenv\Exception\InvalidPathException $e) {
}

defined('YII_DEBUG') or define('YII_DEBUG', env('YII_DEBUG', true));
defined('YII_ENV') or define('YII_ENV', env('YII_ENV', 'dev'));

require(dirname(__DIR__) . '/../vendor/yiisoft/yii2/Yii.php');
require(dirname(__DIR__) . '/../common/config/bootstrap.php');
require(dirname(__DIR__) . '/config/bootstrap.php');

$config = yii\helpers\ArrayHelper::merge(
    require __DIR__ . '/../../common/config/main.php',
    require __DIR__ . '/../config/main.php'
);

(new FrontendApplication($config))->run();
