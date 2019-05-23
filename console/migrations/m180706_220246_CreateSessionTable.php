<?php

namespace console\migrations;

use yii\db\Migration;

/**
 * Class m180706_220246_CreateSessionTable
 */
class m180706_220246_CreateSessionTable extends Migration
{
    public function safeUp()
    {
        if ($this->getDb()->getTableSchema('session') !== null) {
            return;
        }

        $this->createTable('session', [
            'id' => $this->char(40)->notNull()->append('PRIMARY KEY'),
            'expire' => $this->integer(),
            'data' => $this->binary(),
            'user_id' => $this->integer(),
            'last_write' => $this->integer(),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('session');
    }
}
