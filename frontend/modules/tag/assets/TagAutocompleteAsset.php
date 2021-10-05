<?php

namespace frontend\modules\tag\assets;

use frontend\assets\AppAsset;
use yii\web\AssetBundle;

/**
 * Class TagSearchAsset
 * @author Daniil Ilin <daniil.ilin@gmail.com>
 */
class TagAutocompleteAsset extends AssetBundle
{
    /**
     * @var string
     */
    public $sourcePath = '@frontend/modules/tag/resources';

    /**
     * @var array
     */
    public $js = [
        'js/tag-autocomplete.js',
    ];

    /**
     * @var array
     */
    public $css = [
        'css/autocomplete.css',
    ];

    /**
     * @var array
     */
    public $depends = [
        AppAsset::class,
    ];

    /**
     * @param $view
     * @return AssetBundle
     */
    public static function initialize($view)
    {
        $view->registerJs("FP.Autocomplete.init()");
        return parent::register($view);
    }
}