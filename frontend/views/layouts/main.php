<?php

/* @var $this \yii\web\View */
/* @var $content string */

use frontend\assets\AppAsset;
use yii\helpers\Html;
use common\widgets\Alert;

AppAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<?= $this->render("_top-menu"); ?>
<div id="bg"></div>

<main role="main" class="container pt-2">
    <?= Alert::widget() ?>
    <div class="m-3">
        <?= $content ?>
    </div>
</main>

<?= $this->render("_footer-menu"); ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
