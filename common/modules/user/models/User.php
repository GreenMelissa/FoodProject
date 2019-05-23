<?php

namespace common\modules\user\models;

use common\modules\user\query\UserQuery;
use dektrium\user\models\User as BaseUser;
use yii\db\ActiveRecord;
use common\modules\user\service\RoleService;
use yii\db\AfterSaveEvent;

/**
 * Class User
 * @package common\modules\user\models
 */
class User extends BaseUser
{
    const ROLE_ADMIN = 'admin';
    const ROLE_USER = 'user';

    const EVENT_AFTER_SAVE = 'afterSave';

    /**
     * @return array
     */
    public function behaviors()
    {
        return [];
    }

    /**
     * Проверяет корректность пароля.
     * @param  string $password
     * @return bool
     */
    public function validatePassword(string $password) : bool
    {
        try {
            if (password_verify($password, $this->password_hash)) {
                if (password_needs_rehash($this->password_hash, PASSWORD_DEFAULT)) {
                    $this->updateAttributes([
                        'password_hash' => password_hash($password, PASSWORD_DEFAULT)
                    ]);
                }

                return true;
            }
        } catch (\Exception $e) {
            return false;
        }

        return false;
    }

    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        if ($insert) {
            $this->auth_key = \Yii::$app->security->generateRandomString();
        }

        if ($this->password) {
            $this->password_hash = password_hash($this->password, PASSWORD_DEFAULT);
        }

        return ActiveRecord::beforeSave($insert);
    }

    /**
     * @inheritdoc
     */
    public function afterSave($insert, $changedAttributes)
    {
        if ($insert) {
            $profile = new Profile();
            $profile->link('user', $this);
        }

        if ($insert) {
            $this->setRole(\Yii::createObject(RoleService::class)->getDefaultRole());
        }

        $this->trigger(self::EVENT_AFTER_SAVE, \Yii::createObject(AfterSaveEvent::class));

        return ActiveRecord::afterSave($insert, $changedAttributes);
    }

    /**
     * @return string Текущая роль пользователя.
     */
    public function getRole()
    {
        $roles = \Yii::$app->authManager->getRolesByUser($this->id);

        if (empty($roles)) {
            return null;
        }

        reset($roles);

        return $roles[key($roles)]->name;
    }

    /**
     * Изменяет роль пользователя.
     * @param  string $role
     * @return bool
     */
    public function setRole(string $role) : bool
    {
        if (!in_array($role, $this->getAvailableRoles())) {
            return false;
        }
        $auth = \Yii::$app->authManager;

        if ($this->getRole() != null) {
            $auth->revoke($auth->getRole($this->getRole()), $this->getId());
        }

        $auth->assign($auth->getRole($role), $this->getId());

        return true;
    }

    /**
     * @return array
     */
    public function getAvailableRoles(): array
    {
        return [
            self::ROLE_ADMIN,
            self::ROLE_USER,
        ];
    }

    /**
     * @return UserQuery
     */
    public static function find()
    {
        return new UserQuery(get_called_class());
    }
}