<?php

namespace frontend\modules\food\migrations;

use console\components\Migration;

/**
 * Создание таблиц кухонь, тэгов и их связи
 * @author Daniil Ilin <daniil.ilin@gmail.com>
 */
class M210929131823CreateFoodModuleTables extends Migration
{
    public function up()
    {
        $this->createTable('food', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->comment('Название кухни'),
        ]);

        $this->createTable('tag', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull()->comment('Тэг'),
        ]);

        $this->createTable('food_to_tag', [
            'food_id' => $this->integer()->notNull(),
            'tag_id' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey(
            'fk_food_to_tag_food',
            'food_to_tag',
            'food_id',
            'food',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk_food_to_tag_tag',
            'food_to_tag',
            'tag_id',
            'tag',
            'id',
            'CASCADE'
        );

        $this->addPrimaryKey('food_to_tag_pk', 'food_to_tag', ['food_id', 'tag_id']);
        $this->createIndex('food_to_tag_idx', 'food_to_tag', ['tag_id', 'food_id']);
    }

    public function down()
    {
        $this->dropTable('food_to_tag');
        $this->dropTable('food');
        $this->dropTable('tag');
    }
}
