<?php

namespace frontend\modules\food\controllers;

use frontend\modules\food\forms\FoodForm;
use frontend\modules\food\models\Food;
use frontend\modules\food\repositories\FoodRepository;
use frontend\modules\food\services\FoodService;
use yii\base\InvalidConfigException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * Class FoodController
 * @author Daniil Ilin <daniil.ilin@gmail.com>
 */
class FoodController extends Controller
{
    /**
     * @var FoodRepository
     */
    private $foodRepository;

    /**
     * Конструктор
     *
     * @param $id
     * @param $module
     * @param FoodRepository $foodRepository
     * @param array $config
     */
    public function __construct($id, $module, FoodRepository $foodRepository, $config = [])
    {
        $this->foodRepository = $foodRepository;
        parent::__construct($id, $module, $config);
    }

    /**
     * Список кухонь
     *
     * @return string
     * @throws \yii\base\InvalidConfigException
     */
    public function actionIndex()
    {
        return $this->render('index', [
            'dataProvider' => $this->foodRepository->getAllDataProvider(),
        ]);
    }

    /**
     * Создание кухни
     *
     * @return string|Response
     * @throws \Throwable
     */
    public function actionCreate()
    {
        $model = new Food();
        $service = new FoodService($model);

        if ($service->getModel()->load(post()) && $service->process()) {
            \Yii::$app->session->setFlash('success', 'Кухня успешно создана');
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'service' => $service,
        ]);
    }

    /**
     * Редактирование кухни
     *
     * @param int $id
     * @return string|Response
     * @throws InvalidConfigException
     * @throws NotFoundHttpException
     * @throws \Throwable
     */
    public function actionUpdate(int $id)
    {
        $model = $this->findModel($id);
        $service = new FoodService($model);

        if ($service->getModel()->load(post()) && $service->process()) {
            \Yii::$app->session->setFlash('success', 'Кухня успешно отредактирована');
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'service' => $service,
        ]);
    }

    /**
     * Удаление кухни
     *
     * @param int $id
     * @return Response
     * @throws InvalidConfigException
     * @throws NotFoundHttpException
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete(int $id)
    {
        $model = $this->findModel($id);
        $model->delete();

        return $this->redirect('index');
    }

    /**
     * @param int $id
     * @return array|Food|null
     * @throws NotFoundHttpException
     * @throws InvalidConfigException
     */
    private function findModel(int $id)
    {
        $model = Food::find()->byId($id)->one();

        if (!$model instanceof Food) {
            throw new NotFoundHttpException('Кухня не найдена');
        }

        return $model;
    }
}