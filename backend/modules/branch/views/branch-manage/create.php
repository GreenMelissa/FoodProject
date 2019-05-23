<?php

/**
 * @var $service BranchService
 */

use backend\modules\branch\service\BranchService;

$this->title = Yii::t('app', 'Создание ветки');

?>

<div class="branch-form">
    <?= $this->render('_form', ['model' => $service->getBranch(), 'service' => $service]); ?>
</div>
