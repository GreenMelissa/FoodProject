<?php

namespace frontend\modules\builder\migrations;

use console\components\Migration;

class M181113195327ChangeForeignKeysOnBuilderTables extends Migration
{
    public function safeUp()
    {
        $this->dropForeignKey('fk_user_build_to_user', 'user_build');
        $this->dropForeignKey('fk_user_build_to_build', 'user_build');
        $this->dropForeignKey('fk_skill_to_branch', 'skill');

        $this->addForeignKey('fk_user_build_to_user', 'user_build', 'user_id','user', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('fk_user_build_to_build', 'user_build', 'build_id','build', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('fk_skill_to_branch', 'skill', 'branch_id','branch', 'id', 'CASCADE', 'RESTRICT');
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_user_build_to_user', 'user_build');
        $this->dropForeignKey('fk_user_build_to_build', 'user_build');
        $this->dropForeignKey('fk_skill_to_branch', 'skill');

        $this->addForeignKey('fk_user_build_to_user', 'user_build', 'user_id','user', 'id', 'SET NULL', 'SET NULL');
        $this->addForeignKey('fk_user_build_to_build', 'user_build', 'build_id','build', 'id', 'SET NULL', 'SET NULL');
        $this->addForeignKey('fk_skill_to_branch', 'skill', 'branch_id','branch', 'id', 'SET NULL', 'SET NULL');
    }
}
