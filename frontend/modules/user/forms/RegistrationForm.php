<?php

namespace frontend\modules\user\forms;

use yii\base\Model;
use common\modules\user\models\User;

/**
 * Class RegistrationForm
 * @property string $login
 * @property string $password
 * @package frontend\models
 */
class RegistrationForm extends Model
{
    /**
     * @var string
     */
    public $username;
    /**
     * @var string
     */
    public $password;

    /**
     * validation rules
     *
     * @return array
     */
    public function rules()
    {
        return [
            [['password', 'username'], 'required'],
            ['username', 'unique', 'targetClass' => User::class],
            ['password', 'string', 'min' => 6, 'max' => 10],
        ];
    }

    /**
     * @return bool
     * @throws \Throwable
     */
    public function register()
    {
        if (!$this->validate()) {
            return false;
        }

        $user = new User([
            'username' => $this->username,
            'password' => $this->password,
        ]);

        $transaction = \Yii::$app->db->beginTransaction();
        try {
            $user->save(false);
            \Yii::$app->user->login($user);
            $transaction->commit();
            return true;
        } catch (\Throwable $e) {
            \Yii::error($e);
            $transaction->rollBack();
            throw $e;
        }
    }
}