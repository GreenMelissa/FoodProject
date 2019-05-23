<?php

namespace common\fixtures;

use frontend\modules\builder\models\Skill;
use yii\test\ActiveFixture;

/**
 * Class SkillFixture
 * @author Daniil Ilin <daniil.ilin@gmail.com>
 */
class SkillFixture extends ActiveFixture
{
    public $modelClass = Skill::class;
}