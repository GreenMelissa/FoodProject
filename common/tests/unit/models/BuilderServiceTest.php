<?php

namespace common\tests\unit\models;

use Codeception\Test\Unit;
use frontend\modules\builder\service\BuilderService;
use Mockery\Mock;
use yii\helpers\Json;

/**
 * Class BuilderServiceTest
 */
class BuilderServiceTest extends Unit
{
    /**
     * Проверка корректности работы функции при корректных параметрах
     */
    public function testCreateSkillBarDataCorrect()
    {
        // получение мок объекта
        $service = $this->getBuilderServiceMock();
        // инициализация данных
        $data = [1, 2, 3, 4, 5, 6];
        // проверка работы метода с установленными данными
        verify($service->createSkillBarData($data))->true();
    }

    /**
     * Проверка корректности работы функции при некорректных параметрах (отрицательное число)
     */
    public function testCreateSkillBarDataNegative()
    {
        $service = $this->getBuilderServiceMock();
        $data = [1, 2, 3, 4, 5, -6];
        verify($service->createSkillBarData($data))->false();
    }

    /**
     * Проверка корректности работы функции при некорректных параметрах (7 элементов в массиве)
     */
    public function testCreateSkillBarDataIncorrect()
    {
        $service = $this->getBuilderServiceMock();
        $data = [1, 2, 3, 4, 5, 6, 7];
        verify($service->createSkillBarData($data))->false();
    }

    /**
     * @return Mock|BuilderService
     */
    protected function getBuilderServiceMock()
    {
        // смотреть SetRoleTest
        // здесь простой мок объекта, в принципе можно даже обойтись без него (можно обойтись, потому что класс BuilderService
        // не модель ActiveRecord и к БД никаких запросов не делает), но так правильнее
        return \Mockery::mock(BuilderService::class)->makePartial();
    }
}