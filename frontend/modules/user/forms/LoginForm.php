<?php

namespace frontend\modules\user\forms;

use yii\base\Model;
use common\modules\user\models\User;

/**
 * Class LoginForm
 * @package frontend\modules\user\forms
 */
class LoginForm extends Model
{
    const REMEMBER_ME_TIME = 7 * 3600 * 24;

    /**
     * @var string
     */
    public $username;

    /**
     * @var string
     */
    public $password;

    /**
     * @var User
     */
    private $_user;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password'], 'required', 'message' => t('app', 'Все поля обязательны для заполнения')],
            ['password', 'validatePassword'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'phone' => t('app', 'Телефон'),
            'password' => t('app', 'Пароль'),
        ];
    }

    /**
     * Проверяет введенный пароль.
     */
    public function validatePassword()
    {
        if ($this->getUser() === null) {
            $this->addError('password', 'Неправильный логин или пароль');
        } else if (!$this->getUser()->validatePassword($this->password)) {
            $this->addError('password', 'Неправильный логин или пароль');
        }
    }

    /**
     * @return bool
     */
    public function login() : bool
    {
        if (!$this->validate()) {
            return false;
        }

        \Yii::$app->user->login($this->getUser(), self::REMEMBER_ME_TIME);

        return true;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        if ($this->_user === null && !empty($this->username)) {
            $this->_user = User::find()->byUsername($this->username)->one();
        }

        return $this->_user;
    }
}
