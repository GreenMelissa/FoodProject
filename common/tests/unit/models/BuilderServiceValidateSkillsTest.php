<?php

namespace common\tests\unit\models;

use Codeception\Test\Unit;
use common\fixtures\SkillFixture;
use frontend\modules\builder\forms\BuildForm;
use frontend\modules\builder\service\BuilderService;

/**
 * Class BuilderServiceValidateSkillsTest
 */
class BuilderServiceValidateSkillsTest extends Unit
{
    /**
     * Смотреть LoginFormTest
     * В данном случае создаются записи в БД в таблицах Skill (ID от 1 до 5)
     *
     * @return array
     */
    public function _fixtures()
    {
        return [
            'skill' => [
                'class' => SkillFixture::class,
                'dataFile' => codecept_data_dir() . 'skill.php'
            ]
        ];
    }

    /**
     * Тест валидации навыков с навыками, которые имеются в БД
     */
    public function testValidateCorrectSkills()
    {
        $service = new BuilderService();
        $data = [1, 2, 3, 4, 5];

        expect('Валидация должна пройти', $service->validateSkills($data))->true();
    }

    /**
     * Тест валидации навыков с навыками, которых нет в БД
     */
    public function testValidateIncorrectSkills()
    {
        $service = new BuilderService();
        $data = [1, 2, 3, 4, 5, 6];

        expect('Валидация не должна пройти', $service->validateSkills($data))->false();
    }

    /**
     * Тест валидации навыков с пустым массивом навыков
     */
    public function testValidateEmptySkills()
    {
        $service = new BuilderService();
        $data = [];

        expect('Валидация не должна пройти', $service->validateSkills($data))->false();
    }

    /**
     * Тест валидации навыков с навыками, равными NULL
     */
    /**public function testValidateNullSkills()
    {
        $service = new BuilderService();
        $data = null;

        expect('Валидация не должна пройти', $service->validateSkills($data))->false();
    }**/

    /**
     * Тест создания билда с валидными данными
     */
    public function testCreateBuildCorrect()
    {
        // создание формы
        $form = new BuildForm();
        // создание сервиса
        $service = new BuilderService();
        // инициализация данных
        $service->skillBar = [1, 2, 3, 4, 5];
        $form->magicka = 10;
        $form->strength = 15;
        $form->stamina = 20;
        // передача формы в сервис
        $service->buildForm = $form;
        // тут по сути идет симуляция заполнения формы на сайте и нажатия кнопки "создать билд"

        expect('Успешное создания билда', $service->createBuild())->true();
    }

    /**
     * Тест создания билда с невалидными данными
     */
    public function testCreateBuildIncorrect()
    {
        $form = new BuildForm();
        $service = new BuilderService();
        $service->skillBar = [1, 2, 3, 4, 6];
        $form->magicka = 100;
        $form->strength = 150;
        $form->stamina = 200;
        $service->buildForm = $form;

        expect('Не удается создать билд', $service->createBuild())->false();
    }
}