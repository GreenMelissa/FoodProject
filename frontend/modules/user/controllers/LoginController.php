<?php

namespace frontend\modules\user\controllers;

use yii\web\Controller;
use frontend\modules\user\forms\LoginForm;
use yii\web\Response;
use yii\widgets\ActiveForm;

/**
 * Class LoginController
 * @package frontend\modules\user\controllers
 */
class LoginController extends Controller
{
    /**
     * @return array|string|Response
     */
    public function actionLogin()
    {
        $model = new LoginForm();

        if ($model->load(post()) && post('ajax') !== null) {
            \Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if ($model->load(post()) && $model->login()) {
            return $this->goHome();
        }

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * @return Response
     */
    public function actionLogout()
    {
        \Yii::$app->user->logout();
        return $this->goHome();
    }
}