<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Class AdaptiveTableAsset
 * @author Daniil Ilin <daniil.ilin@gmail.com>
 */
class AdaptiveTableAsset extends AssetBundle
{
    /**
     * @var string
     */
    public $sourcePath = '@frontend//resources';

    /**
     * @var array
     */
    public $css = [
        'css/adaptive-table.css',
    ];

    /**
     * @var array
     */
    public $js = [
        'js/adaptive-table.js',
    ];

    /**
     * @var array
     */
    public $depends = [
        AppAsset::class,
    ];
}