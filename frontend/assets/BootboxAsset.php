<?php

namespace frontend\assets;

use yii\bootstrap\BootstrapAsset;
use yii\bootstrap\BootstrapPluginAsset;
use yii\web\AssetBundle;
use yii\web\JqueryAsset;

/**
 * Class BootboxAsset
 * @package frontend\assets
 * @author Daniil Ilin <daniil.ilin@gmail.com>
 */
final class BootboxAsset extends AssetBundle
{
    /**
     * @var string
     */
    public $sourcePath = '@bower/bootbox/src';

    /**
     * @var array
     */
    public $js = [
        'bootbox.js',
    ];

    /**
     * @var array
     */
    public $depends = [
        JqueryAsset::class,
        BootstrapAsset::class,
        BootstrapPluginAsset::class,
    ];
}