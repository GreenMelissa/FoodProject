<?php

namespace frontend\modules\builder\models;

use common\modules\user\models\User;
use yii\behaviors\BlameableBehavior;
use yii\db\ActiveRecord;
use frontend\modules\builder\query\SkillQuery;

/**
 * Class Build
 * @package common\modules\builder\models
 *
 * @property integer $id
 * @property integer $user_id
 * @property string  $name
 * @property array   $skill_bar
 * @property integer $alliance
 * @property integer $race
 * @property integer $class
 * @property integer $mundusstone
 * @property integer $primary_weapon
 * @property integer $secondary_weapon
 * @property integer $magicka
 * @property integer $health
 * @property integer $stamina
 * @property integer $light_armor
 * @property integer $medium_armor
 * @property integer $heavy_armor
 * @property User $user
 * @author Daniil Ilin <daniil.ilin@gmail.com>
 */
class Build extends ActiveRecord
{
    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            'blameable' => [
                'class' => BlameableBehavior::class,
                'createdByAttribute' => 'user_id',
                'updatedByAttribute' => 'user_id',
             ],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => t('app', 'Название'),
            'magicka' => t('app', 'Магия'),
            'stamina' => t('app', 'Выносливость'),
            'strength' => t('app', 'Сила'),
        ];
    }

    /**
     * @return SkillQuery
     */
    public static function find()
    {
        return new SkillQuery(get_called_class());
    }

    /**
     * @return string
     */
    public static function tableName()
    {
        return 'build';
    }
}