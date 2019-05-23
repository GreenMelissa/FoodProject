<?php

/**
 * @var $model   Branch
 * @var $service BranchService
 */

use backend\modules\branch\service\BranchService;
use frontend\modules\builder\models\Branch;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use kartik\select2\Select2;

?>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'name', ['labelOptions' => ['class' => 'font-weight-bold']])->textInput() ?>

<?= $form->field($model, 'type', ['labelOptions' => ['class' => 'font-weight-bold']])->widget(Select2::class, [
    'data' => [],
    'options' => [
        'placeholder' => Yii::t('app', 'Тип заклинания'),
    ],
]) ?>

<?= $form->field($model, 'image')->fileInput(['accept' => 'image/*']) ?>

<?= $form->field($model, 'parent_id', ['labelOptions' => ['class' => 'font-weight-bold']])->widget(Select2::class, [
    'data' => [],
    'options' => [
        'placeholder' => Yii::t('app', 'Родительский навык'),
    ],
]) ?>

<?= $form->field($model, 'branch_id', ['labelOptions' => ['class' => 'font-weight-bold']])->widget(Select2::class, [
    'data' => $service->getBranchRepository()->getBranchList(),
    'options' => [
        'placeholder' => Yii::t('app', 'Ветка'),
    ],
]) ?>

<?= $form->field($model, 'cast_time', ['labelOptions' => ['class' => 'font-weight-bold']])->textInput() ?>

<?= $form->field($model, 'target', ['labelOptions' => ['class' => 'font-weight-bold']])->textInput() ?>

<?= $form->field($model, 'cost', ['labelOptions' => ['class' => 'font-weight-bold']])->textInput() ?>

<?= $form->field($model, 'range', ['labelOptions' => ['class' => 'font-weight-bold']])->textInput() ?>

<?= $form->field($model, 'description', ['labelOptions' => ['class' => 'font-weight-bold']])->textInput() ?>

<?= $form->field($model, 'duration', ['labelOptions' => ['class' => 'font-weight-bold']])->textInput() ?>

<?= $form->field($model, 'morph_effect', ['labelOptions' => ['class' => 'font-weight-bold']])->textInput() ?>

<?= $form->field($model, 'rank_to_unlocked', ['labelOptions' => ['class' => 'font-weight-bold']])->textInput() ?>

<div class="form-group">
    <?php if ($model->isNewRecord) : ?>
        <?= Html::submitButton(Yii::t('app', 'Создать навык'), ['class' => 'btn btn-primary']) ?>
    <?php else : ?>
        <?= Html::submitButton(Yii::t('app', 'Редактировать навык'), ['class' => 'btn btn-success']) ?>
    <?php endif ?>
</div>

<?php ActiveForm::end(); ?>
