<?php

namespace frontend\modules\builder\repositories;

use frontend\modules\builder\models\Skill;
use frontend\modules\builder\query\SkillQuery;
use yii\helpers\ArrayHelper;

/**
 * Class SkillRepository
 * @author Daniil Ilin <daniil.ilin@gmail.com>
 */
class SkillRepository
{
    /**
     * @param $id
     * @return Skill|null
     */
    public function findById($id) :?Skill
    {
        return Skill::find()->byId($id)->one();
    }

    /**
     * @return SkillQuery
     */
    public function getActiveQuery(): SkillQuery
    {
        return Skill::find()->orderBy(['id' => \SORT_DESC]);
    }

    /**
     * @return array
     */
    public function getSkillList(): array
    {
        return ArrayHelper::map(
            Skill::find()
                ->select(['skill.id', 'skill.name AS skill_name', 'branch.name AS branch_name'])
                ->from(['branch', 'skill'])
                ->andWhere('branch_id = branch.id')
                ->asArray()
                ->all(),
            'id',
            'skill_name',
            'branch_name'
        );
    }
}