<?php
namespace common\tests\unit\models;

use Codeception\Test\Unit;
use frontend\modules\builder\forms\BuildForm;
use Mockery\Mock;

/**
 * Class BuildFormTest
 */
class BuildFormTest extends Unit
{
    /**
     * Проверка корректности работы функции при параметрах, преувеличивающих допустимые значения
     */
    public function testValidateStatsIfStatsGreater()
    {
        $form = $this->getBuilderFormMock();
        $form->magicka = $form::STATS_MAX_SUM;
        $form->strength = $form::STATS_MAX_SUM;
        $form->stamina = $form::STATS_MAX_SUM;
        verify($form->validateStats())->false();
    }

    /**
     * Проверка корректности работы функции при параметрах, находящихся в области допустимых значений
     */
    public function testValidateStatsIfStatsLess()
    {
        $form = $this->getBuilderFormMock();
        $form->magicka = (int)0;
        $form->strength = (int)0;
        $form->stamina = (int)0;
        verify($form->validateStats())->true();
    }

    /**
     * Проверка корректности работы функции при параметрах, один из которых равен NULL
     */
    public function testValidateStatsWithNull()
    {
        $form = $this->getBuilderFormMock();
        $form->magicka = null;
        $form->strength = 0;
        $form->stamina = 0;
        verify($form->validateStats())->false();
    }

    /**
     * Проверка корректности работы функции при параметрах, один из которых равен отрицательному числу
     */
    public function testValidateStatsWithNegativeNumber()
    {
        $form = $this->getBuilderFormMock();
        $form->magicka = -1;
        $form->strength = 0;
        $form->stamina = 0;
        verify($form->validateStats())->false();
    }

    /**
     * @return Mock|BuildForm
     */
    protected function getBuilderFormMock()
    {
        return \Mockery::mock(BuildForm::class)->makePartial();
    }
}