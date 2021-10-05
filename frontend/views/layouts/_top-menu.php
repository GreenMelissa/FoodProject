<?php

/**
 * @var $this View
 */

use yii\bootstrap\Nav;
use yii\helpers\Url;
use yii\web\View;

?>

<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="<?= Url::home() ?>">
            <?= h(Yii::$app->name) ?>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <?= Nav::widget([
                'options' => ['class' => 'navbar-nav ml-auto'],
                'items' => [
                    ['label' => 'Кухни', 'url' => ['/food/food/index']],
                ],
                'encodeLabels' => false
            ]) ?>
        </div>
    </div>
</nav>

