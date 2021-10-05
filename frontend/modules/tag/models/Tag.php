<?php

namespace frontend\modules\tag\models;

use yii\db\ActiveRecord;

/**
 * Модель сущности "Тэг"
 *
 * @property int    $id
 * @property string $title
 *
 * @author Daniil Ilin <daniil.ilin@gmail.com>
 */
class Tag extends ActiveRecord
{
    /**
     * @return array
     */
    public function rules()
    {
        return [
            ['title', 'string'],
        ];
    }

    /**
     * @return string
     */
    public static function tableName()
    {
        return 'tag';
    }
}