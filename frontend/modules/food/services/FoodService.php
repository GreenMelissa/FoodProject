<?php

namespace frontend\modules\food\services;

use frontend\modules\food\models\Food;
use frontend\modules\tag\models\Tag;
use yii\db\Query;
use yii\helpers\Json;

/**
 * Class FoodService
 * @author Daniil Ilin <daniil.ilin@gmail.com>
 */
class FoodService
{
    /**
     * @var Food
     */
    private $model;

    /**
     * @return Food
     */
    public function getModel(): Food
    {
        return $this->model;
    }

    /**
     * @param Food $model
     * @return $this
     */
    public function setModel(Food $model)
    {
        $this->model = $model;
        return $this;
    }

    /**
     * FoodService constructor.
     * @param Food $form
     */
    public function __construct(Food $form)
    {
        $this->setModel($form);
    }

    /**
     * @return bool
     * @throws \Throwable
     */
    public function process(): bool
    {
        $transaction = \Yii::$app->db->beginTransaction();
        try {
            $this->getModel()->save();
            $this->saveTags();
            $transaction->commit();
            return true;
        } catch (\Throwable $exception) {
            $transaction->rollBack();
            throw $exception;
        }
    }

    /**
     * Сохранение и удаление тэгов кухни
     */
    private function saveTags()
    {
        $tags = Json::decode($this->getModel()->tagList);

        foreach ($tags as &$tag) {
            $tagModel = Tag::find()
                ->where('lower(title) = :title', [':title' => strtolower($tag['title'])])
                ->one();
            if ($tagModel instanceof Tag) {
                $tag['id'] = $tagModel->id;
            } else {
                $newTag = new Tag();
                $newTag->title = $tag['title'];
                $newTag->save();
                $tag['id'] = $newTag->id;
            }
        }

        $assignedTagIds = array_column($this->getModel()->tags, 'id');

        $this->assignTags($tags, $assignedTagIds);
        $this->deleteTags($tags, $assignedTagIds);
    }

    /**
     * Добавляет тэги, которые не были привязаны
     *
     * @param $tagData
     * @param $assignedTags
     * @throws \yii\db\Exception
     */
    private function assignTags($tagData, $assignedTags)
    {
        foreach ($tagData as $tag) {
            if (!in_array($tag['id'], $assignedTags)) {
                \Yii::$app->db->createCommand()
                    ->insert('food_to_tag', [
                        'food_id' => $this->getModel()->id,
                        'tag_id' => $tag['id'],
                    ])->execute();
            }
        }
    }

    /**
     * Удаляет тэги, которые были убраны через UI
     *
     * @param $tagData
     * @param $assignedTags
     * @throws \yii\db\Exception
     */
    private function deleteTags($tagData, $assignedTags)
    {
        foreach ($assignedTags as $id) {
            if (!in_array($id, array_column($tagData, 'id'))) {
                \Yii::$app->db->createCommand()
                    ->delete('food_to_tag', [
                        'food_id' => $this->getModel()->id,
                        'tag_id' => $id,
                    ])->execute();
            }
        }
    }
}