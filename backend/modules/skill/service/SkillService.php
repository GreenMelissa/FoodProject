<?php

namespace backend\modules\skill\service;

use frontend\modules\builder\models\Skill;
use frontend\modules\builder\repositories\BranchRepository;

/**
 * Class SkillService
 * @author Daniil Ilin <daniil.ilin@gmail.com>
 */
class SkillService
{
    /**
     * @var Skill
     */
    private $skill;

    /**
     * @var BranchRepository|object
     */
    private $branchRepository;

    /**
     * SkillService constructor.
     * @param Skill|null $skill
     */
    public function __construct(Skill $skill = null)
    {
        if (!$skill) {
            $skill = new Skill();
        }
        $this->setSkill($skill);
        $this->branchRepository = \Yii::createObject(BranchRepository::class);
    }

    /**
     * @return Skill|null
     */
    public function getSkill(): ?Skill
    {
        return $this->skill;
    }

    /**
     * @param Skill $skill
     * @return SkillService
     */
    public function setSkill(Skill $skill): SkillService
    {
        $this->skill = $skill;
        return $this;
    }

    /**
     * @return BranchRepository
     */
    public function getBranchRepository(): BranchRepository
    {
        return $this->branchRepository;
    }

    /**
     * @return bool
     * @throws \Throwable
     */
    public function process(): bool
    {
        $transaction = \Yii::$app->db->beginTransaction();
        try {
            $this->getSkill()->save();
            $transaction->commit();
            return true;
        } catch (\Throwable $exception) {
            $transaction->rollBack();
            throw $exception;
        }
    }
}