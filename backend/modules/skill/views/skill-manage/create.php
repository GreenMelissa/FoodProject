<?php

/**
 * @var $service SkillService
 */

use backend\modules\skill\service\SkillService;

$this->title = Yii::t('app', 'Создание навыка');

?>

<div class="skill-form">
    <?= $this->render('_form', ['model' => $service->getSkill(), 'service' => $service]); ?>
</div>
