<?php

namespace common\modules\user\migrations;

use console\components\Migration;

class M180712152218UpdateUserTable extends Migration
{
    public function safeUp()
    {
        if ($this->hasColumn('user', 'created_at') && $this->getDb()->getTableSchema('user')->getColumn('created_at')->type == 'integer') {
            $this->execute('ALTER TABLE "user" ALTER COLUMN created_at TYPE timestamp USING to_timestamp(created_at) ');
            $this->execute('ALTER TABLE "user" ALTER COLUMN created_at SET NOT NULL');
            $this->execute('ALTER TABLE "user" ALTER COLUMN created_at SET DEFAULT NOW()');
        }
    }

    public function safeDown()
    {
        echo "M180712152218UpdateUserTable cannot be reverted.\n";

        return false;
    }
}
