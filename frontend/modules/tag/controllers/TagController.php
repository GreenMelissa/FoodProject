<?php

namespace frontend\modules\tag\controllers;

use frontend\modules\tag\repositories\TagRepository;
use yii\web\Controller;

/**
 * Class TagController
 * @author Daniil Ilin <daniil.ilin@gmail.com>
 */
class TagController extends Controller
{
    /**
     * @var TagRepository
     */
    private $tagRepository;

    /**
     * TagController constructor.
     * @param $id
     * @param $module
     * @param TagRepository $tagRepository
     * @param array $config
     */
    public function __construct($id, $module, TagRepository $tagRepository, $config = [])
    {
        $this->tagRepository = $tagRepository;
        parent::__construct($id, $module, $config);
    }

    /**
     * @param string $search
     * @return \yii\web\Response
     */
    public function actionSearch(string $search)
    {
        return $this->asJson($this->tagRepository->searchTags($search));
    }
}