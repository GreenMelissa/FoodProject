<?php

namespace frontend\modules\tag\query;

use yii\db\ActiveQuery;

/**
 * Class TagQuery
 * @author Daniil Ilin <daniil.ilin@gmail.com>
 */
class TagQuery extends ActiveQuery
{
    /**
     * @param int $id
     * @return TagQuery
     */
    public function byId(int $id)
    {
        return $this->andWhere(['id' => $id]);
    }
}