<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Class GlyphIconAsset
 * @package frontend\assets
 * @author Daniil Ilin <daniil.ilin@gmail.com>
 */
class GlyphIconAsset extends AssetBundle
{
    /**
     * @var string
     */
    public $sourcePath = '@bower/glyphicons';

    /**
     * @var array
     */
    public $css = [
        'styles/glyphicons.css',
    ];

    /**
     * @var array
     */
    public $js = [
    ];
}
