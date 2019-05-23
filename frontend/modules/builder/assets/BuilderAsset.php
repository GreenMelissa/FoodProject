<?php

namespace frontend\modules\builder\assets;

use frontend\assets\AppAsset;
use yii\web\AssetBundle;

/**
 * Class BuilderAsset
 * @author Daniil Ilin <daniil.ilin@gmail.com>
 */
class BuilderAsset extends AssetBundle
{
    /**
     * @var string
     */
    public $sourcePath = '@frontend/modules/builder/resources';

    /**
     * @var array
     */
    public $js = [
        'js/builder.js',
    ];

    /**
     * @var array
     */
    public $depends = [
        AppAsset::class,
    ];
}