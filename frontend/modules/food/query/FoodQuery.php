<?php

namespace frontend\modules\food\query;

use yii\db\ActiveQuery;

/**
 * Class FoodQuery
 * @author Daniil Ilin <daniil.ilin@gmail.com>
 */
class FoodQuery extends ActiveQuery
{
    /**
     * @param int $id
     * @return FoodQuery
     */
    public function byId(int $id)
    {
        return $this->andWhere(['id' => $id]);
    }
}