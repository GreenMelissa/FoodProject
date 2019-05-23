<?php

namespace frontend\modules\builder\query;

use frontend\modules\builder\models\Skill;
use yii\db\ActiveQuery;

/**
 * Class SkillQuery
 * @package common\modules\builder\query
 * @author Daniil Ilin <daniil.ilin@gmail.com>
 */
class SkillQuery extends ActiveQuery
{
    /**
     * @param null $db
     * @return array|Skill[]
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @param null $db
     * @return array|null|Skill
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @param $name
     * @return $this
     */
    public function byName($name)
    {
        return $this->andWhere(['LIKE', 'name', mb_strtolower($name)]);
    }

    /**
     * @param $id
     * @return $this
     */
    public function byId($id)
    {
        return $this->andWhere(['id' => $id]);
    }
}