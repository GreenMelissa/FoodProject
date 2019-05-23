<?php

namespace common\tests\unit\models;

use Codeception\Test\Unit;
use Mockery\Mock;
use common\modules\user\models\User;

/**
 * Class ValidatePasswordTest
 */
class ValidatePasswordTest extends Unit
{
    /**
     * Тест валидации пароля с паролем - строкой
     */
    public function testValidatePasswordCorrect()
    {
        $user = $this->getUserMock();
        verify($user->validatePassword('password'))->true();
    }

    /**
     * Тест валидации пароля с паролем равным NULL
     */
    /**public function testValidatePasswordNull()
    {
        $user = $this->getUserMock();
        verify($user->validatePassword(null))->false();
    }**/

    /**
     * @return Mock|User
     */
    protected function getUserMock()
    {
        // смотреть SetRoleTest
        $user = \Mockery::mock(User::class)->makePartial();
        // "симуляция" метода
        $user->allows()->save(\Mockery::any())->andReturn(true);
        // "симуляция" метода
        $user->allows()->updateAttributes(\Mockery::any())->andReturn(true);
        // "симуляция" метода
        $user->allows()->attributes()->andReturn([
            'id',
            'password_hash',
        ]);
        $user->id = 1;
        // хэщ для пароля "password"
        $user->password_hash = '$2y$13$3ytkaFNsRHH3A2C8016yoOIKxSryBxKjyda.bQ3D1yJVGznmPmDju';

        return $user;
    }
}