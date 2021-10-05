<?php

/**
 * @var $dataProvider ActiveDataProvider
 */

$this->title = \Yii::t('app', 'Кухни');

use frontend\modules\food\models\Food;
use yii\data\ActiveDataProvider;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\grid\SerialColumn;
use yii\helpers\Html;
use yii\helpers\Url;

?>

<h1><?= $this->title ?></h1>

<div class="text-right mb-3">
    <?= Html::a(Html::tag('i', '', ['class' => 'fa fa-plus']), ['create'], ['class' => 'btn btn-primary', 'title' => 'Добавить кухню', 'disabled' => true]) ?>
</div>

<?= GridView::widget([
    'id' => 'food-grid',
    'layout' => '{items}{pager}{summary}',
    'dataProvider' => $dataProvider,
    'columns' => [
        [
            'class' => SerialColumn::class,
        ],
        'name',
        [
            'label' => t('food', 'Тэги кухни'),
            'format' => 'raw',
            'contentOptions' => ['class' => 'd-flex'],
            'value' => function(Food $model) {
                $content = '';
                foreach ($model->tags as $tag) {
                  $content .= Html::tag('div', $tag->title, ['class' => 'tag-item ml-2']);
                }
                return $content;
            }
        ],
        [
            'class' => ActionColumn::class,
            'template' => '{update} {delete}',
            'urlCreator' => function ($action, Food $model, $key, $index) {
                switch ($action) {
                    case 'update':
                        return Url::to(['update', 'id' => $model->id]);
                        break;
                    case 'delete':
                        return Url::to(['delete', 'id' => $model->id]);
                        break;
                    default:
                        return null;
                        break;
                }
            },
        ],
    ],
]); ?>
