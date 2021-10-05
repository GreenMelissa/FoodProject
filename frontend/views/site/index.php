<?php

/**
 * @var $this View
 */

use frontend\modules\tag\assets\TagAutocompleteAsset;
use yii\helpers\Html;
use yii\web\View;
use frontend\assets\AdaptiveTableAsset;

$this->title = \Yii::$app->name;

TagAutocompleteAsset::initialize($this);
AdaptiveTableAsset::register($this);
$this->registerJs("$('.td-content').setTooltipIfOverflow();")

?>

<h1 class="text-center">Главная страница Food Project</h1>

<div class="d-flex justify-content-start">
    <div class="js-autocomplete-container">
        <label class="font-weight-bold">Поиск тэгов</label>
        <?= Html::textInput(
            'tag-autocomplete-input',
            null,
            [
                'class' => 'form-control js-tag-input autocomplete',
                'placeholder' => 'Введите тэг...',
            ]
        ) ?>
    </div>
</div>

<table border="1" class="adaptive-table mt-3 text-center">
  <tr>
    <th>Колонка 1</th>
    <th>Колонка 2</th>
    <th>Колонка 2</th>
    <th>Колонка 4</th>
  </tr>
  <tr>
    <td>
      <div class="td-content">
        В этой колонке расположен длинный текст, который должен показывать, как работают стили при переполнении
      </div>
    </td>
    <td>
      <div class="td-content">
        Текст обычной длины
      </div>
    </td>
    <td>
      <div class="td-content">
        Короткий текст
      </div>
    </td>
    <td>
      <div class="td-content">
        Текст обычной длины
      </div>
    </td>
  </tr>
  <tr>
    <td>
      <div class="td-content">
        Короткий текст
      </div>
    </td>
    <td>
      <div class="td-content">
        Текст обычной длины
      </div>
    </td>
    <td>
      <div class="td-content">
        В этой колонке расположен длинный текст, который должен показывать, как работает стили при переполнении
      </div>
    </td>
    <td>
      <div class="td-content">
        Текст обычной длины
      </div>
    </td>
  </tr>
</table>
