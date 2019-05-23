<?php

namespace frontend\modules\builder\models;

use frontend\modules\builder\query\SkillQuery;
use yii\db\ActiveRecord;

/**
 * Class Skill
 * @package common\modules\builder\models
 *
 * @property integer $id
 * @property string  $name
 * @property integer $type
 * @property string  $image
 * @property integer $parent_id
 * @property integer $branch_id
 * @property string  $cast_time
 * @property string  $target
 * @property string  $cost
 * @property string  $range
 * @property string  $description
 * @property string  $duration
 * @property string  $morph_effect
 * @property integer $rank_to_unlocked
 * @author Daniil Ilin <daniil.ilin@gmail.com>
 */
class Skill extends ActiveRecord
{
    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'name' => t('app', 'Название'),
            'parent_id' => t('app', 'Родительский навык'),
            'image' => t('app', 'Иконка'),
            'type' => t('app', 'Тип'),
            'branch_id' => t('app', 'Ветка'),
            'cast_time' => t('app', 'Время произнесения'),
            'rank_to_unlocked' => t('app', 'Требуется очков в ветке для разблокировки'),
            'morph_effect' => t('app', 'Морф эффект'),
            'duration' => t('app', 'Длительность'),
            'description' => t('app', 'Описание'),
            'range' => t('app', 'Дальность применения'),
            'cost' => t('app', 'Стоимость'),
            'target' => t('app', 'Цель'),
        ];
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            ['name', 'string'],
            [['parent_id', 'branch_id'], 'integer'],
            ['branch_id', 'required']
        ];
    }

    /**
     * @return SkillQuery
     */
    public static function find()
    {
        return new SkillQuery(get_called_class());
    }
}