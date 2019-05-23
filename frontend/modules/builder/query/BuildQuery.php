<?php

namespace frontend\modules\builder\query;

use yii\db\ActiveQuery;
use frontend\modules\builder\models\Build;

/**
 * Class BuildQuery
 * @package common\modules\builder\query
 * @author Daniil Ilin <daniil.ilin@gmail.com>
 */
class BuildQuery extends ActiveQuery
{
    /**
     * @param null $db
     * @return array|Build[]
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @param null $db
     * @return array|null|Build
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @param $name
     * @return $this
     */
    public function byName($name): BuildQuery
    {
        return $this->andWhere(['LIKE', 'name', mb_strtolower($name)]);
    }

    /**
     * @param $id
     * @return $this
     */
    public function byId($id): BuildQuery
    {
        return $this->andWhere(['id' => $id]);
    }

    /**
     * @param $id
     * @return $this
     */
    public function byUserId($id): BuildQuery
    {
        return $this->andWhere(['user_id' => $id]);
    }
}