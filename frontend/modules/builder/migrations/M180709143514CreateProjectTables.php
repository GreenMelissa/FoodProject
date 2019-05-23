<?php

namespace frontend\modules\builder\migrations;

use console\components\Migration;

class M180709143514CreateProjectTables extends Migration
{
    public function safeUp()
    {
        $this->createTable('build', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'name' => $this->text(),
            'skill_bar' => $this->json(),
            'alliance' => $this->smallInteger(),
            'race' => $this->smallInteger(),
            'class' => $this->smallInteger(),
            'mundusstone' => $this->smallInteger(),
            'primary_weapon' => $this->smallInteger(),
            'secondary_weapon' => $this->smallInteger(),
            'magicka' => $this->smallInteger(),
            'health' => $this->smallInteger(),
            'stamina' => $this->smallInteger(),
            'light_armor' => $this->smallInteger(),
            'medium_armor' => $this->smallInteger(),
            'heavy_armor' => $this->smallInteger(),
        ]);

        $this->createTable('user_build', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'build_id' => $this->integer(),
        ]);

        $this->addForeignKey('fk_user_build_to_user', 'user_build', 'user_id','user', 'id', 'SET NULL', 'SET NULL');
        $this->addForeignKey('fk_user_build_to_build', 'user_build', 'build_id','build', 'id', 'SET NULL', 'SET NULL');

        $this->createTable('skill', [
            'id' => $this->primaryKey(),
            'name' => $this->text(),
            'type' => $this->smallInteger(),
            'image' => $this->text(),
            'parent_id' => $this->integer(),
            'branch_id' => $this->integer()->notNull(),
            'cast_time' => $this->text(),
            'target' => $this->text(),
            'cost' => $this->text(),
            'range' => $this->text(),
            'description' => $this->text(),
            'duration' => $this->text(),
            'morph_effect' => $this->text(),
            'rank_to_unlocked' => $this->smallInteger(),
        ]);

        $this->createTable('branch', [
            'id' => $this->primaryKey(),
            'name' => $this->text(),
            'parent_id' => $this->integer(),
        ]);

        $this->addForeignKey('fk_skill_to_branch', 'skill', 'branch_id','branch', 'id', 'SET NULL', 'SET NULL');
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_user_build_to_user', 'user_build');
        $this->dropForeignKey('fk_user_build_to_build', 'user_build');
        $this->dropForeignKey('fk_skill_to_branch', 'skill');

        $this->dropTable('user_build');
        $this->dropTable('build');
        $this->dropTable('skill');
        $this->dropTable('branch');
    }
}
