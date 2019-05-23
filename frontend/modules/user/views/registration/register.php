<?php

/**
 * @var $model RegistrationForm
 */

use frontend\modules\user\forms\RegistrationForm;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = 'Регистрация';
?>

<h1>Регистрация</h1>

<?php $form = ActiveForm::begin(['class' => 'form-horizontal']); ?>

<?= $form->field($model,'username')->textInput()->label("Введите логин:")?>
<?= $form->field($model,'password')->passwordInput()->label('Введите пароль:') ?>
<?= Html::submitButton('Зарегистрироваться', ['class' => 'btn btn-primary']) ?>

<?php ActiveForm::end(); ?>
