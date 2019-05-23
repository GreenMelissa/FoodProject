<?php

namespace backend\modules\branch\service;

use frontend\modules\builder\models\Branch;
use frontend\modules\builder\repositories\BranchRepository;
use yii\helpers\ArrayHelper;

/**
 * Class BranchService
 * @author Daniil Ilin <daniil.ilin@gmail.com>
 */
class BranchService
{
    /**
     * @var Branch
     */
    private $branch;

    /**
     * @var BranchRepository
     */
    private $branchRepository;

    /**
     * BranchService constructor.
     * @param Branch|null $branch
     */
    public function __construct(Branch $branch = null)
    {
        if (!$branch) {
            $branch = new Branch();
        }
        $this->setBranch($branch);
        $this->branchRepository = \Yii::createObject(BranchRepository::class);
    }

    /**
     * @return Branch|null
     */
    public function getBranch(): ?Branch
    {
        return $this->branch;
    }

    /**
     * @param Branch $branch
     * @return BranchService
     */
    public function setBranch(Branch $branch): BranchService
    {
        $this->branch = $branch;
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
            if ($this->getBranch()->save()) {
                $transaction->commit();
                return true;
            } else {
                $transaction->rollBack();
                return false;
            }
        } catch (\Throwable $exception) {
            $transaction->rollBack();
            throw $exception;
        }
    }
}