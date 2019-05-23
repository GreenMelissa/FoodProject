<?php

namespace common\tests\unit\models;

use Codeception\Test\Unit;
use Mockery\Mock;
use common\modules\user\models\User;

/**
 * Class ResetPasswordTest
 */
class ResetPasswordTest extends Unit
{
    /**
     * Тест сброса пароля с новым паролем - строкой
     */
    public function testResetPasswordCorrect()
    {
        $user = $this->getUserMock();
        verify($user->resetPassword('new_password'))->true();
    }

    /**
     * Тест сброса пароля с новым паролем - NULL
     */
    /**public function testResetPasswordNull()
    {
        $user = $this->getUserMock();
        verify($user->resetPassword(null))->false();
    }**/

    /**
     * @return Mock|User
     */
    protected function getUserMock()
    {
        // смотреть SetRoleTest
        $user = \Mockery::mock(User::class)->makePartial();
        $user->allows()->save(\Mockery::any())->andReturn(true);
        $user->allows()->updateAttributes(\Mockery::any())->andReturn(true);
        $user->allows()->attributes()->andReturn([
            'id',
            'password_hash',
        ]);
        $user->id = 1;

        return $user;
    }
}