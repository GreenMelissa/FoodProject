<?php

namespace frontend\assets;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;
use yii\web\View;


/**
 * Class AppAsset
 * @package frontend\assets
 * @author Daniil Ilin <daniil.ilin@gmail.com>
 */
class AppAsset extends AssetBundle
{
    /**
     * @var string
     */
    public $sourcePath = '@frontend/resources';

    /**
     * @var array
     */
    public $css = [
        'css/site.css',
    ];

    /**
     * @var array
     */
    public $js = [
        'js/site.js',
    ];

    /**
     * @var array
     */
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'frontend\assets\GlyphIconAsset',
        JqueryAsset::class,
        BootboxAsset::class,
    ];

    /**
     * @inheritdoc
     */
    public function init()
    {
        \Yii::$app->view->registerCssFile('//fonts.googleapis.com/css?family=Open+Sans', [
            'type' => 'text/css',
        ]);
        \Yii::$app->view->registerJsFile('https://use.fontawesome.com/releases/v5.0.4/js/all.js', ['defer' => true]);
    }

    /**
     * @param $image
     * @param View|null $view
     * @return string
     */
    public static function getImgUrl($image, View $view = null)
    {
        if (!$view) {
            $view = \Yii::$app->view;
        }

        return static::register($view)->baseUrl . '/img/' . $image;
    }
}
