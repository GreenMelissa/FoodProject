<?php

namespace frontend\modules\food\repositories;

use frontend\modules\food\models\Food;
use yii\base\InvalidConfigException;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;

/**
 * Class FoodRepository
 * @author Daniil Ilin <daniil.ilin@gmail.com>
 */
class FoodRepository
{
    /**
     * @return ActiveDataProvider
     * @throws InvalidConfigException
     */
    public function getAllDataProvider()
    {
        $query = Food::find();

        return $this->getProvider($query);
    }

    /**
     * @param ActiveQuery $query
     * @return ActiveDataProvider
     */
    private function getProvider(ActiveQuery $query)
    {
        return new ActiveDataProvider([
            'query' => $query,
        ]);
    }
}