<?php

namespace common\tests\unit\models;

use Yii;
use frontend\modules\user\forms\LoginForm;
use common\fixtures\UserFixture;
use Codeception\Test\Unit;

/**
 * Login form test
 */
class LoginFormTest extends Unit
{
    /**
     * Fixture создает в тестовой базе (на время выполнения теста) записи с данными указанными в файле по пути dataFile
     * В данном случае создает запись в таблице User
     * Так как в этом тесте используется БД, то это в любом случае интеграционный тест, потому что тест взаимодействует,
     * как минимум с БД (помимо других модулей приложения)
     *
     * !!! БД ТЕСТОВАЯ !!!
     *
     * (после выполнения тестов, данные сразу удаляются)
     *
     * @return array
     */
    public function _fixtures()
    {
        return [
            'user' => [
                'class' => UserFixture::class,
                'dataFile' => codecept_data_dir() . 'user.php'
            ]
        ];
    }

    /**
     * Тест на логин пользователя с указанием несуществующих данных
     */
    public function testLoginNoUser()
    {
        // создание модели формы авторизации
        $model = new LoginForm([
            'username' => 'not_existing_username',
            'password' => 'not_existing_password',
        ]);

        // попытка логина и проверка как отработала функция
        expect('model should not login user', $model->login())->false();
        // Проверка на то, является ли текущий юзер гостем или нет (предыдущая функция пытается логинит пользователя)
        expect('user should not be logged in', Yii::$app->user->isGuest)->true();
    }

    /**
     * Тест на логин пользователя с указанием верного логина, но неправильного пароля
     */
    public function testLoginWrongPassword()
    {
        // создание модели формы авторизации
        $model = new LoginForm([
            'username' => 'user',
            'password' => 'wrong_password',
        ]);

        // попытка логина и проверка как отработала функция
        expect('model should not login user', $model->login())->false();
        // проверка, есть ли ошибки в пароле
        expect('error message should be set', $model->errors)->hasKey('password');
        // Проверка на то, является ли текущий юзер гостем или нет
        expect('user should not be logged in', Yii::$app->user->isGuest)->true();
    }

    /**
     * Тест на логин пользователя с указанием правильных данных
     */
    public function testLoginCorrect()
    {
        // создание модели формы авторизации
        $model = new LoginForm([
            'username' => 'user',
            'password' => 'password_0',
        ]);

        // попытка логина и проверка как отработала функция
        expect('model should login user', $model->login())->true();
        // проверка, есть ли ошибки в пароле
        expect('error message should not be set', $model->errors)->hasntKey('password');
        // Проверка на то, является ли текущий юзер гостем или нет (предыдущая функция пытается логинит пользователя)
        expect('user should be logged in', Yii::$app->user->isGuest)->false();
    }
}
