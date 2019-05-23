<?php

use yii\bootstrap\Nav;

?>


<div class="card">
    <div class="card-body">
        <?= Nav::widget([
            'options' => ['class' => 'nav flex-column'],
            'encodeLabels' => false,
            'items' => [
                [
                    'label' => \Yii::t('app', 'Навыки'),
                    'url' => ['/admin/skill/skill-manage/index'],
                ],
                [
                    'label' => \Yii::t('app', 'Ветки'),
                    'url' => ['/admin/branch/branch-manage/index'],
                ],
            ],
        ]);
        ?>
    </div>
</div>