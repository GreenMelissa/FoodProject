<?php
/**
 * Created by PhpStorm.
 * User: kirix
 * Date: 26.07.18
 * Time: 14:05
 */
namespace common\modules\user\repositories;

use yii\db\Query;

class StatisticRepository
{
    public function onlineUsers()
    {
        return (new Query())
            ->from('session')
            ->where(['>','last_write',time()-300]) //300 - секунды, 5 минут, активность за последние 5 минут
            ->count();
    }
}