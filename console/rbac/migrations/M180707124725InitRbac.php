<?php

namespace console\rbac\migrations;

use dektrium\rbac\migrations\Migration;
use common\modules\user\models\User;

class M180707124725InitRbac extends Migration
{
    public function safeUp()
    {
        $auth = \Yii::$app->authManager;

        $admin = $auth->createRole(User::ROLE_ADMIN);
        $auth->add($admin);

        $user = $auth->createRole(User::ROLE_USER);
        $auth->add($user);

        $auth->assign($admin, 1);
        $auth->assign($user, 2);
    }

    public function safeDown()
    {
        $auth = \Yii::$app->authManager;

        $auth->removeAll();
    }
}
