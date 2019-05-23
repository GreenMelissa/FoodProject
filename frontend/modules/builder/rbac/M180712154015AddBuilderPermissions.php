<?php

namespace frontend\modules\builder\rbac;

use common\modules\user\models\User;
use dektrium\rbac\migrations\Migration;
use backend\BackendModule;

class M180712154015AddBuilderPermissions extends Migration
{
    public function safeUp()
    {
        $this->createPermission(BackendModule::PERM_INDEX_SKILL, 'Может просматривать список скиллов');
        $this->createPermission(BackendModule::PERM_INDEX_BRANCH, 'Может просматривать список веток');
        $this->createPermission(BackendModule::PERM_INDEX_BUILD, 'Может просматривать список билдов');
        $this->createPermission(BackendModule::PERM_MANAGE_SKILL, 'Может редактировать скиллы');
        $this->createPermission(BackendModule::PERM_MANAGE_BRANCH, 'Может редактировать ветки');
        $this->createPermission(BackendModule::PERM_MANAGE_BUILD, 'Может редактировать билды');
        $this->createPermission(BackendModule::PERM_DELETE_SKILL, 'Может удалять скиллы');
        $this->createPermission(BackendModule::PERM_DELETE_BRANCH, 'Может удалять ветки');
        $this->createPermission(BackendModule::PERM_DELETE_BUILD, 'Может удалять билды');

        $this->addChild(User::ROLE_ADMIN, BackendModule::PERM_INDEX_SKILL);
        $this->addChild(User::ROLE_ADMIN, BackendModule::PERM_INDEX_BRANCH);
        $this->addChild(User::ROLE_ADMIN, BackendModule::PERM_INDEX_BUILD);
        $this->addChild(User::ROLE_ADMIN, BackendModule::PERM_MANAGE_SKILL);
        $this->addChild(User::ROLE_ADMIN, BackendModule::PERM_MANAGE_BRANCH);
        $this->addChild(User::ROLE_ADMIN, BackendModule::PERM_MANAGE_BUILD);
        $this->addChild(User::ROLE_ADMIN, BackendModule::PERM_DELETE_SKILL);
        $this->addChild(User::ROLE_ADMIN, BackendModule::PERM_DELETE_BRANCH);
        $this->addChild(User::ROLE_ADMIN, BackendModule::PERM_DELETE_BUILD);
    }
    
    public function safeDown()
    {
        $this->removeItem(BackendModule::PERM_INDEX_SKILL);
        $this->removeItem(BackendModule::PERM_INDEX_BRANCH);
        $this->removeItem(BackendModule::PERM_INDEX_BUILD);
        $this->removeItem(BackendModule::PERM_MANAGE_SKILL);
        $this->removeItem(BackendModule::PERM_MANAGE_BRANCH);
        $this->removeItem(BackendModule::PERM_MANAGE_BUILD);
        $this->removeItem(BackendModule::PERM_DELETE_SKILL);
        $this->removeItem(BackendModule::PERM_DELETE_BRANCH);
        $this->removeItem(BackendModule::PERM_DELETE_BUILD);
    }
}
