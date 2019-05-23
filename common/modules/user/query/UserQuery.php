<?php

namespace common\modules\user\query;

use yii\db\ActiveQuery;
use yii\db\Query;

/**
 * Class UserQuery
 * @package common\modules\user\query
 */
class UserQuery extends ActiveQuery
{
    /**
     * @param null $db
     * @return array|\yii\db\ActiveRecord[]
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @param null $db
     * @return array|null|\yii\db\ActiveRecord
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @param $email
     * @return $this
     */
    public function byEmail($email)
    {
        return $this->andWhere(['(LOWER(email))' => trim(mb_strtolower($email))]);
    }

    /**
     * @param $username
     * @return $this
     */
    public function byUsername($username)
    {
        return $this->andWhere(['username' => $username]);
    }
}