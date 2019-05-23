<?php

/**
 * @var $this View
 * @var $model Build
 */

use frontend\modules\builder\models\Build;
use frontend\modules\builder\models\Skill;
use yii\web\View;

?>


<h1><?= $model->name ?></h1>

<?php foreach ($model->skill_bar as $skill) : ?>
    <?php if ($skill) : ?>
        <p><?= Skill::find()->byId($skill)->one()->name ?></p>
    <?php endif ?>
<?php endforeach; ?>
