<?php

namespace frontend\modules\tag\repositories;

use frontend\modules\tag\models\Tag;

/**
 * Class TagRepository
 * @author Daniil Ilin <daniil.ilin@gmail.com>
 */
class TagRepository
{
    /**
     * Поиск тэгов по вхождению строки
     *
     * @param $search
     * @return array
     */
    public function searchTags($search)
    {
        return Tag::find()
            ->select('title')
            ->where(['like', 'title', $search . '%', false])
            ->column();
    }
}