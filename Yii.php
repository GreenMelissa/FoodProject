<?php

/**
 * Yii bootstrap file.
 * Used for enhanced IDE code autocompletion.
 */
class Yii extends \yii\BaseYii
{
    /**
     * @var BaseApplication|WebApplication|ConsoleApplication the application instance
     */
    public static $app;
}

spl_autoload_register(['Yii', 'autoload'], true, true);
Yii::$classMap = include(__DIR__ . '/../vendor/yiisoft/yii2/classes.php');
Yii::$container = new yii\di\Container;

/**
 * Class BaseApplication
 *
 * @property yii\mail\BaseMailer $mailer
 * @property common\modules\user\models\User $user
 */
abstract class BaseApplication extends yii\base\Application
{
}

/**
 * Class WebApplication
 */
class WebApplication extends yii\web\Application
{
}

/**
 * Class ConsoleApplication
 */
class ConsoleApplication extends yii\console\Application
{
}