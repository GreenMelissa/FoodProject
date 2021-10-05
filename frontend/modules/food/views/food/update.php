<?php

/**
 * @var $service FoodService
 * @var $this View
 */


use frontend\modules\food\services\FoodService;
use yii\web\View;

$this->title = \Yii::t('food', 'Редактирование кухни');

?>

<?= $this->render('_form', [
  'model' => $service->getModel(),
]) ?>