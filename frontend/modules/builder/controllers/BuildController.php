<?php

namespace frontend\modules\builder\controllers;

use backend\BackendModule;
use frontend\modules\builder\models\Build;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;

class BuildController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'accessControl' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['create'],
                        'allow' => true,
                        'roles' => [BackendModule::PERM_MANAGE_BUILD],
                    ],
                    [
                        'actions' => ['view'],
                        'allow' => true,
                        'roles' => [BackendModule::PERM_INDEX_BUILD],
                    ],
                ],
            ],
        ];
    }

    public function actionView($id)
    {
        $model = $this->findModel($id);

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * @param int $id
     * @return array|Build|\frontend\modules\builder\models\Skill|null
     * @throws NotFoundHttpException
     */
    private function findModel(int $id)
    {
        $model = Build::find()->byId($id)->one();

        if ($model instanceof Build) {
            return $model;
        }

        throw new NotFoundHttpException();
    }
}