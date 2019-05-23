<?php

/**
 * @var $model LoginForm
 */

use frontend\modules\user\forms\LoginForm;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = 'Войти';
?>

<h1>Вход в систему</h1>

<?php $form = ActiveForm::begin([
    'class'=>'form-horizontal',
    'enableAjaxValidation' => true,
]);?>

<?= $form->field($model,'username')->textInput()->label("Введите логин:")?>
<?= $form->field($model,'password')->passwordInput()->label('Введите пароль:')?>
<?= Html::submitButton('Войти', ['class' => 'btn btn-primary']) ?>

<?php $form = ActiveForm::end();?>