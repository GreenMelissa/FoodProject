<?php

/**
 * @var $this yii\web\View
 */

$this->title = Yii::$app->name . ' - Панель управления';

?>

<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">Сводка по сайту</h3>
    </div>
    <div class="panel-body">

        <?php
        $totalusers = \Yii::$app->db->createCommand('SELECT COUNT(*) as vl FROM "user";')->queryOne();
        $userstd = \Yii::$app->db->createCommand('SELECT COUNT(*) as vl FROM "user" WHERE created_at::DATE = current_date;')->queryOne();
        $usersyd = \Yii::$app->db->createCommand('SELECT COUNT(*) as vl FROM "user" WHERE created_at::DATE = current_date  - \'1 day\'::INTERVAL;')->queryOne();
        ?>

        <div class="row">
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">Сводка</h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped table-bordered table-hover">
                            <tr>
                                <td>Пользователей</td>
                                <td>сегодня: <?= $userstd['vl']; ?></td>
                                <td>вчера: <?= $usersyd['vl']; ?></td>
                                <td>всего: <?= $totalusers['vl']; ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
