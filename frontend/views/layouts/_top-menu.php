<?php

/**
 * @var $this View
 */

use yii\bootstrap\Nav;
use yii\helpers\Url;
use yii\web\View;
use yii\helpers\Html;
use common\modules\user\models\User;

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
                'options' => ['class' => 'navbar-nav mr-auto'],
                'items' => [
                    [
                        'label' => 'Админка',
                        'url' => ['/admin'],
                        'visible' => \Yii::$app->user->can(User::ROLE_ADMIN),
                    ],
                ],
            ]) ?>
            <?php
                if (Yii::$app->user->isGuest) {
                    $menuItems[] = ['label' => 'Регистрация', 'url' => ['/user/registration/register']];
                    $menuItems[] = ['label' => 'Авторизация', 'url' => ['/user/login/login']];
                } else {
                    $menuItems[] = '<li>'
                        . Html::beginForm(['/user/login/logout'], 'post')
                        . Html::submitButton(
                            'Выход',
                            ['class' => 'btn btn-link logout']
                        )
                        . Html::endForm()
                        . '</li>';
                }
            ?>
            <?= Nav::widget([
                'options' => ['class' => 'navbar-nav ml-auto'],
                'items' => $menuItems,
                'encodeLabels' => false
            ]) ?>
        </div>
    </div>
</nav>

