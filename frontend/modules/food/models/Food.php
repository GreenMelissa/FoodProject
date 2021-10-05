<?php

namespace frontend\modules\food\models;

use common\validators\JsonValidator;
use frontend\modules\food\query\FoodQuery;
use frontend\modules\tag\models\Tag;
use yii\base\InvalidConfigException;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * Модель сущности "Кухня"
 *
 * @property int    $id
 * @property string $name
 * @property Tag[]  $tags
 * @author Daniil Ilin <daniil.ilin@gmail.com>
 */
class Food extends ActiveRecord
{
    /**
     * Минимальная длина названия кухни
     */
    const MIN_NAME_LENGTH = 5;

    /**
     * Максимальная длина названия кухни
     */
    const MAX_NAME_LENGTH = 255;

    /**
     * @var string
     */
    public $tagList;

    /**
     * @return array
     */
    public function rules()
    {
        return [
            ['name', 'required'],
            ['name', 'string', 'min' => self::MIN_NAME_LENGTH, 'max' => self::MAX_NAME_LENGTH],
            ['tagList', JsonValidator::class],
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'name' => \Yii::t('food', 'Название'),
        ];
    }

    /**
     * @return ActiveQuery
     * @throws InvalidConfigException
     */
    public function getTags()
    {
        return $this
            ->hasMany(Tag::class, ['id' => 'tag_id'])
            ->viaTable('food_to_tag', ['food_id' => 'id']);
    }

    /**
     * @return array
     */
    public function getTagList()
    {
        $data = [];

        foreach ($this->tags as $tag) {
            $data[] = [
                'title' => $tag->title,
            ];
        }

        return $data;
    }

    /**
     * @return object|FoodQuery
     * @throws InvalidConfigException
     */
    public static function find()
    {
        return \Yii::createObject(FoodQuery::class, [get_called_class()]);
    }

    /**
     * @return string
     */
    public static function tableName()
    {
        return 'food';
    }
}