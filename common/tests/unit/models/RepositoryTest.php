<?php

namespace common\tests\unit\models;

use Codeception\Test\Unit;
use common\fixtures\BranchFixture;
use common\fixtures\SkillFixture;
use frontend\modules\builder\models\Branch;
use frontend\modules\builder\models\Skill;
use frontend\modules\builder\repositories\BranchRepository;
use frontend\modules\builder\repositories\SkillRepository;

/**
 * Class RepositoryTest
 */
class RepositoryTest extends Unit
{
    /**
     * Смотреть LoginFormTest
     * В данном случае создаются записи в БД в таблицах Skill и Branch (ID от 1 до 5)
     *
     * @return array
     */
    public function _fixtures()
    {
        return [
            'skill' => [
                'class' => SkillFixture::class,
                'dataFile' => codecept_data_dir() . 'skill.php'
            ],
            'branch' => [
                'class' => BranchFixture::class,
                'dataFile' => codecept_data_dir() . 'branch.php'
            ]
        ];
    }

    /**
     * Тест поиска навыка по корректному ID
     */
    public function testFindSkillCorrect()
    {
        $repository = new SkillRepository();
        // проверка, найденная запись в БД является ли моделью Skill
        expect('Навык должен найтись в БД', $repository->findById(1) instanceof Skill)->true();
    }

    /**
     * Тест поиска навыка по NULL
     */
    public function testFindSkillNull()
    {
        $repository = new SkillRepository();
        // проверка, найденная запись в БД является ли моделью Skill
        expect('Навык не должен найтись в БД', $repository->findById(null) instanceof Skill)->false();
    }

    /**
     * Тест поиска навыка по некорректному ID
     */
    public function testFindNotExistingSkill()
    {
        $repository = new SkillRepository();
        // проверка, найденная запись в БД является ли моделью Skill
        expect('Навык не должен найтись в БД', $repository->findById(6) instanceof Skill)->false();
    }

    /**
     * Тест поиска ветки по корректному ID
     */
    public function testFindBranchCorrect()
    {
        $repository = new BranchRepository();
        // проверка, найденная запись в БД является ли моделью Branch
        expect('Навык должен найтись в БД', $repository->findById(1) instanceof Branch)->true();
    }

    /**
     * Тест поиска ветки по NULL
     */
    public function testFindBranchNull()
    {
        $repository = new BranchRepository();
        // проверка, найденная запись в БД является ли моделью Branch
        expect('Навык не должен найтись в БД', $repository->findById(null) instanceof Branch)->false();
    }

    /**
     * Тест поиска ветки по некорректному ID
     */
    public function testFindNotExistingBranch()
    {
        $repository = new BranchRepository();
        // проверка, найденная запись в БД является ли моделью Branch
        expect('Навык не должен найтись в БД', $repository->findById(6) instanceof Branch)->false();
    }
}