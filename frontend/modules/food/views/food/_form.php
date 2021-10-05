<?php

/**
 * @var $model Food
 * @var $this View
 */

use frontend\modules\food\assets\FoodFormAsset;
use frontend\modules\food\models\Food;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

FoodFormAsset::initialize($this, $model->isNewRecord ? [] : $model->getTagList());

?>

<h1><?= $this->title ?></h1>

<?php $form = ActiveForm::begin([
    'options' => [
        'class' => 'js-food-form',
    ],
]); ?>

<?= $form->field($model, 'name', ['labelOptions' => ['class' => 'font-weight-bold']])->textInput() ?>

<label class="font-weight-bold">Список тэгов</label>
<?= Html::textInput('tag_input', null, [
    'class' => 'form-control js-food-tag-input',
]) ?>

<?= $form->field($model, 'tagList')->hiddenInput(['class' => 'js-tag-list-field'])->label(false) ?>

<div class="d-flex flex-row mb-2 js-tag-container"></div>

<div class="form-group">
    <?php if ($model->isNewRecord) : ?>
        <?= Html::button(Yii::t('app', 'Создать'), ['class' => 'btn btn-primary js-submit-button']) ?>
    <?php else : ?>
        <?= Html::button(Yii::t('app', 'Редактировать'), ['class' => 'btn btn-success js-submit-button']) ?>
    <?php endif ?>
</div>

<?php ActiveForm::end(); ?>
