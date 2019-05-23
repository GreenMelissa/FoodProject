<?php

namespace frontend\modules\builder\migrations;

use console\components\Migration;

class M181119155403AddColumnsToBranchTable extends Migration
{
    public function safeUp()
    {
        $this->addColumn('branch', 'class_id', $this->integer());
        $this->addColumn('branch', 'race_id', $this->integer());
    }

    public function safeDown()
    {
        $this->dropColumn('branch', 'class_id');
        $this->dropColumn('branch', 'race_id');
    }
}
