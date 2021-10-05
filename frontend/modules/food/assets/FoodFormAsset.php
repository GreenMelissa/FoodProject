<?php

namespace frontend\modules\food\assets;

use frontend\assets\AppAsset;
use yii\helpers\Json;
use yii\web\AssetBundle;

/**
 * Class FoodFormAsset
 * @author Daniil Ilin <daniil.ilin@gmail.com>
 */
class FoodFormAsset extends AssetBundle
{
    /**
     * @var string
     */
    public $sourcePath = '@frontend/modules/food/resources';

    /**
     * @var array
     */
    public $js = [
        'js/food-form.js',
    ];

    /**
     * @var array
     */
    public $depends = [
        AppAsset::class,
    ];

    /**
     * @param \yii\web\View $view
     * @return AssetBundle
     */
    public static function initialize($view, array $tagList)
    {
        $tagListJson = Json::encode($tagList);
        $view->registerJs("FP.FoodForm.init($tagListJson)");
        return parent::register($view);
    }
}