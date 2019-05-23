<?php

namespace frontend\modules\builder\repositories;

use frontend\modules\builder\models\Branch;
use frontend\modules\builder\query\BranchQuery;
use yii\helpers\ArrayHelper;

/**
 * Class BranchRepository
 * @author Daniil Ilin <daniil.ilin@gmail.com>
 */
class BranchRepository
{
    /**
     * @param $id
     * @return Branch|null
     */
    public function findById($id) :?Branch
    {
        return Branch::find()->byId($id)->one();
    }

    /**
     * @return BranchQuery
     */
    public function getActiveQuery(): BranchQuery
    {
        return Branch::find()->orderBy(['id' => \SORT_DESC]);
    }

    /**
     * @return array
     */
    public function getBranchList(): array
    {
        return ArrayHelper::map(
            Branch::find()->all(),
            'id',
            'name'
        );
    }

    /**
     * @return array|Branch[]
     */
    public function getBranchTree()
    {
        $branches = Branch::find()->asArray()->indexBy('id')->all();
        foreach ($branches as &$branch) {
            $this->setChild($branch, $branches);
        }
        foreach ($branches as &$branch) {
            if ($branch['parent_id'] !== null) {
                unset($branches[$branch['id']]);
            }
        }
        return $branches;
    }

    /**
     * @param $parent
     * @param $branches
     */
    private function setChild(&$parent, &$branches)
    {
        foreach ($branches as &$branch) {
            if ($branch['parent_id'] === $parent['id']) {
                $parent['child'][$branch['id']] = &$branch;
            }
        }
        foreach ($parent['child'] ?? [] as &$child) {
            $this->setChild($child, $branches);
        }
    }
}