<?php

namespace common\modules\user\models;

use dektrium\user\models\Profile as BaseProfile;

/**
 * Class Profile
 * @package common\modules\user\models
 */
class Profile extends BaseProfile
{
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}