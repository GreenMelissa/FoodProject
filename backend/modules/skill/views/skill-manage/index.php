<?php

/**
 * @var ActiveDataProvider $dataProvider
 * @var SkillSearch $searchModel
 */

use frontend\modules\builder\models\Skill;
use frontend\modules\builder\models\SkillSearch;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\helpers\Html;

$this->title = Yii::t('app', 'Навыки');

?>

<h1><?= $this->title ?></h1>

<div class="text-right mb-3">
    <?= Html::a(Html::tag('i', '', ['class' => 'fa fa-plus']), ['create'], ['class' => 'btn btn-primary', 'title' => 'Создать заклинание', 'disabled' => true]) ?>
</div>

<?= GridView::widget([
    'id' => 'collection-grid',
    'layout' => '{items}{pager}{summary}',
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        [
            'class' => 'yii\grid\SerialColumn'
        ],
        'name',
        'description',
        [
            'class' => yii\grid\ActionColumn::class,
            'template' => '{update} {delete}',
            'urlCreator' => function ($action, Skill $model, $key, $index) {
                if ($action == 'update') {
                    return Url::to(['update', 'id' => $model->id]);
                }
                if ($action == 'delete') {
                    return Url::to(['delete', 'id' => $model->id]);
                }
            },
        ],
    ],
]); ?>
