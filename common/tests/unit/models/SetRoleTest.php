<?php

namespace common\tests\unit\models;

use Codeception\Test\Unit;
use common\modules\user\models\User;
use dektrium\rbac\components\DbManager;
use dektrium\rbac\components\ManagerInterface;
use Mockery\Mock;

/**
 * Class SetRoleTest
 */
class SetRoleTest extends Unit
{
    /**
     * Тест установки роли с правильной ролью
     */
    public function testSetRoleCorrect()
    {
        // получение мок объекта (так будет во всех блочных тестах)
        $user = $this->getUserMock();
        // мок еще одного объекта, который используется внутри функции setRole()
        \Yii::$container->set(ManagerInterface::class, \Mockery::mock(DbManager::class)->makePartial());
        // проверка работы функции
        verify($user->setRole(User::ROLE_ADMIN))->true();
    }

    /**
     * Тест установки роли с неверной ролью
     */
    public function testSetRoleWrongRole()
    {
        // получение мок объекта (так будет во всех блочных тестах)
        $user = $this->getUserMock();
        // мок еще одного объекта, который используется внутри функции setRole()
        \Yii::$container->set(ManagerInterface::class, \Mockery::mock(DbManager::class)->makePartial());
        verify($user->setRole('not_existing_role'))->false();
    }

    /**
     * Тест установки роли с передачей null вместо роли
     */
    /**public function testSetRoleNoRole()
    {
        // получение мок объекта (так будет во всех блочных тестах)
        $user = $this->getUserMock();
        // мок еще одного объекта, который используется внутри функции setRole()
        \Yii::$container->set(ManagerInterface::class, \Mockery::mock(DbManager::class)->makePartial());
        // проверка работы функции
        verify($user->setRole(null))->true();
    }**/

    /**
     * @return Mock|User
     */
    protected function getUserMock()
    {
        // мок объекта User
        // мок - это создание объекта с такими же свойствами, полями и функциями, но без реализации этих функций
        // Это нужно для того, чтобы получить объект, который не взаимодействует с БД (в данном случае, это ActiveRecord)
        $user = \Mockery::mock(User::class)->makePartial();
        // Разрешаем метод save (всегда будет отдавать true). В этом тесте мы не будем ничего сохранять в БД, это блочный тест, нам нельзя
        // обращаться к базе, поэтому мы "симулируем" выполнение функции save
        $user->allows()->save(\Mockery::any())->andReturn(true);
        // Точно так же "симулируется" метод attributes() (по умолчанию в классе ActiveRecord он пытается получить из БД список атрибутов модели)
        $user->allows()->attributes()->andReturn([
            'id',
        ]);
        //присвоение ID нашему "виртуальному" (его нет в БД) пользователю
        $user->id = 1;

        /**
         * Если здесь возникнет вопрос, что такое модель (а именно ActiveRecord) и как она связана с бд, то самое простое объяснение примерно такое
         * "Это строка из БД в виде класса PHP", то есть, если у нас есть строка в таблице user с email = some@mail.ru то и в модели User будет такое свойство
         * email с таким же значением
         */

        return $user;
    }
}