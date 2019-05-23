<?php

/**
 * @var $model   Branch
 * @var $service BranchService
 */

use backend\modules\branch\service\BranchService;
use frontend\modules\builder\enums\ClassEnum;
use frontend\modules\builder\enums\RaceEnum;
use frontend\modules\builder\models\Branch;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use kartik\select2\Select2;

?>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'name', ['labelOptions' => ['class' => 'font-weight-bold']])->textInput() ?>

<?= $form->field($model, 'parent_id', ['labelOptions' => ['class' => 'font-weight-bold']])->widget(Select2::class, [
    'data' => $service->getBranchRepository()->getBranchList(),
    'options' => [
        'placeholder' => Yii::t('app', 'Родительская ветка'),
    ],
]) ?>

<?= $form->field($model, 'class_id', ['labelOptions' => ['class' => 'font-weight-bold']])->widget(Select2::class, [
    'data' => ClassEnum::getItems(),
    'options' => [
        'placeholder' => Yii::t('app', 'Класс, к которому принадлежит ветка'),
    ],
]) ?>

<?= $form->field($model, 'race_id', ['labelOptions' => ['class' => 'font-weight-bold']])->widget(Select2::class, [
    'data' => RaceEnum::getItems(),
    'options' => [
        'placeholder' => Yii::t('app', 'Раса, к которой принадлежит ветка'),
    ],
]) ?>

<div class="form-group">
    <?php if ($model->isNewRecord) : ?>
        <?= Html::submitButton(Yii::t('app', 'Создать ветку'), ['class' => 'btn btn-primary']) ?>
    <?php else : ?>
        <?= Html::submitButton(Yii::t('app', 'Редактировать ветку'), ['class' => 'btn btn-success']) ?>
    <?php endif ?>
</div>

<?php ActiveForm::end(); ?>
