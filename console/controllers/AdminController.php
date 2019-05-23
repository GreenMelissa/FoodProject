<?php

namespace console\controllers;

use common\modules\user\models\User;
use yii\console\Controller;

/**
 * @author Dmitry Erofeev <dmeroff@gmail.com>
 */
class AdminController extends Controller
{
    /**
     * Изменяет роль пользователя.
     * @param  int    $userId
     * @param  string $role
     * @return int
     */
    public function actionRole($userId, $role)
    {
        /** @var User $user */
        $user = User::findOne($userId);

        if ($user === null) {
            $this->stderr('user not found');
            return 1;
        }

        $user->setRole($role);

        return 0;
    }

    /**
     * Изменяет пароль пользователя.
     * @param  mixed  $idOrEmail
     * @param  string $password
     * @return int
     */
    public function actionPassword($idOrEmail, $password)
    {
        if (filter_var($idOrEmail, FILTER_VALIDATE_EMAIL) === false) {
            $user = User::findOne($idOrEmail);
        } else {
            $user = User::find()->byEmail($idOrEmail)->one();
        }

        if ($user === null) {
            $this->stderr("user not found");
            return 1;
        }

        $user->resetPassword($password);

        $this->stdout("password changed\n");

        return 0;
    }
}