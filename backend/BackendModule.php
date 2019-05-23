<?php

namespace backend;

use backend\modules\branch\BranchModule;
use backend\modules\skill\SkillModule;
use yii\base\Module;

/**
 * @author Daniil Ilin <daniil.ilin@gmail.com>
 */
class BackendModule extends Module
{
    const PERM_INDEX_SKILL = 'indexSkill';
    const PERM_MANAGE_SKILL = 'manageSkill';
    const PERM_DELETE_SKILL = 'deleteSkill';

    const PERM_INDEX_BRANCH = 'indexBranch';
    const PERM_MANAGE_BRANCH = 'manageBranch';
    const PERM_DELETE_BRANCH = 'deleteBranch';

    const PERM_INDEX_BUILD = 'indexBuild';
    const PERM_MANAGE_BUILD = 'manageBuild';
    const PERM_DELETE_BUILD = 'deleteBuild';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $this->layout = 'main';

        $this->modules = [
            'skill' => SkillModule::class,
            'branch' => BranchModule::class,
        ];
    }
}