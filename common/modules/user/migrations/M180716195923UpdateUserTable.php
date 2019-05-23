<?php

namespace common\modules\user\migrations;

use console\components\Migration;

class M180716195923UpdateUserTable extends Migration
{
    public function safeUp()
    {
        $this->dropColumn('user', 'created_at');
        $this->dropColumn('user', 'updated_at');
        $this->dropColumn('user', 'flags');
        $this->dropColumn('user', 'last_login_at');
        $this->dropColumn('user', 'confirmed_at');
        $this->dropColumn('user', 'blocked_at');
        $this->dropColumn('user', 'registration_ip');
        $this->addColumn('user', 'created_at', $this->timestamp()->notNull()->defaultExpression('NOW()'));
    }

    public function safeDown()
    {
        echo "M180716195923UpdateUserTable cannot be reverted.\n";

        return false;
    }
}
