<?php

namespace frontend\modules\builder\query;

use frontend\modules\builder\models\Branch;
use yii\db\ActiveQuery;

/**
 * Class BranchQuery
 * @package common\modules\builder\query
 * @author Daniil Ilin <daniil.ilin@gmail.com>
 */
class BranchQuery extends ActiveQuery
{
    /**
     * @param null $db
     * @return array|Branch[]
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @param null $db
     * @return array|null|Branch
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @param $name
     * @return $this
     */
    public function byName($name): BranchQuery
    {
        return $this->andWhere(['LIKE', 'name', mb_strtolower($name)]);
    }

    /**
     * @param $id
     * @return $this
     */
    public function byId($id): BranchQuery
    {
        return $this->andWhere(['id' => $id]);
    }

    /**
     * @param $id
     * @return $this
     */
    public function byParentId($id): BranchQuery
    {
        return $this->andWhere(['parent_id' => $id]);
    }
}