<?php

namespace frontend\modules\builder\models;

use frontend\modules\builder\enums\ClassEnum;
use frontend\modules\builder\query\BranchQuery;
use yii\db\ActiveRecord;
use frontend\modules\builder\enums\RaceEnum;

/**
 * Class Branch
 * @package common\modules\builder\models
 *
 * @property integer $id
 * @property string $name
 * @property integer $parent_id
 * @author Daniil Ilin <daniil.ilin@gmail.com>
 */
class Branch extends ActiveRecord
{
    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'name' => t('app', 'Название'),
            'parent_id' => t('app', 'Родительская ветка'),
            'class_id' => t('app', 'Класс, к которому принадлежит ветка'),
            'race_id' => t('app', 'Раса, к которой принадлежит ветка'),
        ];
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            ['name', 'string'],
            [['parent_id'],
                'exist',
                'targetClass' => Branch::class,
                'targetAttribute' => 'id'
            ],
            [['class_id', 'race_id'], 'integer'],
            ['class_id', 'in', 'range' => ClassEnum::getKeys()],
            ['race_id', 'in', 'range' => RaceEnum::getKeys()],
        ];
    }

    /**
     * @return BranchQuery
     */
    public static function find()
    {
        return new BranchQuery(get_called_class());
    }
}