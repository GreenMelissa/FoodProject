<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\StringHelper;
use yii\helpers\Url;
use yii\helpers\HtmlPurifier;

if (!function_exists('env')) {
    /**
     * Gets the value of an environment variable. Supports boolean, empty and null.
     *
     * @param  string  $key
     * @param  mixed   $default
     * @return mixed
     */
    function env($key, $default = null)
    {
        $value = getenv($key);
        if ($value === false) {
            return $default;
        }
        switch (strtolower($value)) {
            case 'true':
                return true;
            case 'false':
                return false;
            case 'empty':
                return '';
            case 'null':
                return null;
        }
        if (strlen($value) > 1 && StringHelper::startsWith($value, '"') && StringHelper::endsWith($value, '"')) {
            return substr($value, 1, -1);
        }
        return $value;
    }
}

if (!function_exists('h')) {
    /**
     * @param  string $value
     * @param  bool   $doubleEncode
     * @return string
     */
    function h($value, $doubleEncode = true)
    {
        return Html::encode($value, $doubleEncode);
    }
}

if (!function_exists('post')) {
    /**
     * Возвращает значение из массива $_POST
     * @param  string|null $name
     * @param  mixed|null  $defaultValue
     * @return array|mixed
     */
    function post(string $name = null, $defaultValue = null)
    {
        return Yii::$app->request->post($name, $defaultValue);
    }
}

if (!function_exists('get')) {
    /**
     * Возвращает значение из массива $_GET
     * @param  string|null $name
     * @param  mixed|null  $defaultValue
     * @return array|mixed
     */
    function get(string $name = null, $defaultValue = null)
    {
        return Yii::$app->request->get($name, $defaultValue);
    }
}

if (!function_exists('can')) {
    /**
     * @param  string $permissionName
     * @param  array  $params
     * @param  bool   $allowCaching
     * @return bool
     */
    function can(string $permissionName, array $params = [], bool $allowCaching = true)
    {
        return Yii::$app->user->can($permissionName, $params, $allowCaching);
    }
}

if (!function_exists('t')) {
    /**
     * @param string $category the message category.
     * @param string $message the message to be translated.
     * @param array $params the parameters that will be used to replace the corresponding placeholders in the message.
     * @param string $language the language code (e.g. `en-US`, `en`). If this is null, the current
     * [[\yii\base\Application::language|application language]] will be used.
     * @return string the translated message.
     */
    function t($category, $message, $params = [], $language = null)
    {
        return Yii::t($category, $message, $params, $language);
    }
}

if (!function_exists('flash')) {
    /**
     * @param $key
     * @param $message
     */
    function flash($key, $message)
    {
        Yii::$app->session->setFlash($key, $message);
    }
}


if (!function_exists('userId')) {
    /**
     * @return int|string
     */
    function userId()
    {
        return Yii::$app->user->id;
    }
}

if (!function_exists('isGuest')) {
    /**
     * @return bool
     */
    function isGuest()
    {
        return Yii::$app->user->isGuest;
    }
}

if (!function_exists('isLoggedIn')) {
    /**
     * @return bool
     */
    function isLoggedIn()
    {
        return !Yii::$app->user->isGuest;
    }
}

if (!function_exists('isPowerOfTwo')) {
    /**
     * Проверяет, является ли аргумент степенью двойки.
     *
     * @param $x
     * @return bool
     */
    function isPowerOfTwo($x): bool
    {
        return ($x & ($x - 1)) == 0;
    }
}

if (!function_exists('purify')) {
    /**
     * Wrapper for HtmlPurifier::process.
     *
     * @param  string              $content
     * @param  array|\Closure|null $config
     * @return string
     */
    function purify($content, $config = null)
    {
        return HtmlPurifier::process($content, $config);
    }
}

if (!function_exists('t')) {
    /**
     * Wrapper for Yii::t.
     *
     * @param  string $category
     * @param  string $message
     * @param  array  $params
     * @param  string $language
     * @return string
     */
    function t($category, $message, $params = [], $language = null)
    {
        return Yii::t($category, $message, $params, $language);
    }
}

if (!function_exists('param')) {
    /**
     * Helper function for retrieving application params.
     *
     * @param  string $name
     * @param  mixed  $default
     * @return mixed
     */
    function param($name, $default = null)
    {
        return ArrayHelper::getValue(Yii::$app->params, $name, $default);
    }
}

if (!function_exists('url')) {
    /**
     * Wrapper for Url::to.
     *
     * @param  mixed       $url
     * @param  bool|string $scheme
     * @return string
     */
    function url($url = '', $scheme = false)
    {
        return Url::to($url, $scheme);
    }
}

if (!function_exists('swap')) {
    /**
     * Меняет значения местами.
     *
     * @param $var1
     * @param $var2
     */
    function swap(&$var1, &$var2)
    {
        $tmp = $var1;
        $var1 = $var2;
        $var2 = $tmp;
    }
}
