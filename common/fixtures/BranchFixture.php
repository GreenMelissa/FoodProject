<?php

namespace common\fixtures;

use frontend\modules\builder\models\Branch;
use yii\test\ActiveFixture;

/**
 * Class BranchFixture
 * @author Daniil Ilin <daniil.ilin@gmail.com>
 */
class BranchFixture extends ActiveFixture
{
    public $modelClass = Branch::class;
}