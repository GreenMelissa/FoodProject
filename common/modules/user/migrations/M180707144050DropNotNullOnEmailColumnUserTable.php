<?php

namespace common\modules\user\migrations;

use console\components\Migration;

class M180707144050DropNotNullOnEmailColumnUserTable extends Migration
{
    public function safeUp()
    {
        $this->dropNotNull('user', 'email');
    }

    public function safeDown()
    {
        $this->setNotNull('user', 'email');
    }
}
