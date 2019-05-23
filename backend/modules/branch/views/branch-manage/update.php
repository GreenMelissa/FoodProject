<?php

/**
 * @var $service BranchService
 */

use backend\modules\branch\service\BranchService;

$this->title = Yii::t('app', 'Редактирование ветки');

?>

<div class="branch-form">
    <?= $this->render('_form', ['model' => $service->getBranch(), 'service' => $service]); ?>
</div>
