<?php

/**
 * Url manager configuration.
 * @see http://www.yiiframework.com/doc-2.0/guide-runtime-routing.html
 */

return [
    'enablePrettyUrl' => env('URL_ENABLE_PRETTY', true),
    'enableStrictParsing' => env('URL_STRICT_PARSING', false),
    'showScriptName' => env('URL_SHOW_SCRIPT_NAME', false),
    'baseUrl' => env('URL_BASE'),
    'hostInfo' => env('URL_HOST_INFO'),
    'scriptUrl' => env('URL_SCRIPT'),
    'suffix' => env('URL_SUFFIX'),
    'normalizer' => [
        'class' => 'yii\web\UrlNormalizer',
        'collapseSlashes' => true,
        'normalizeTrailingSlash' => true,
    ],
    'rules' => [
        // главная
        '' => 'site/index',
        // css
        'css' => 'theme/css/get',
        // менеджер
        'admin' => 'admin',
        'admin/<controller>/<action>' => 'admin/<controller>/<action>',
        'admin/<module>/<controller>/<action>' => 'admin/<module>/<controller>/<action>',
        // логин, регистрация, сброс пароля
        '<action:login|logout>' => 'user/security/<action>',
        'auth/<authclient>' => 'user/security/auth',
        '<action:connect>/<method:finish>/<code>' => 'user/registration/<action>',
        '<action:connect>/<code>' => 'user/registration/<action>',
        '<action:join|register|update-profile>' => 'user/registration/<action>',
        '<action:request>' => 'user/recovery/<action>',
        'profile' => 'user/profile/index',
        'cabinet' => 'cabinet/site/update',
    ],
];