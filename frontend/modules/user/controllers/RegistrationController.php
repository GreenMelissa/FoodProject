<?php

namespace frontend\modules\user\controllers;

use yii\web\Controller;
use frontend\modules\user\forms\RegistrationForm;

/**
 * Class RegController
 * @package frontend\controllers
 */
class RegistrationController extends Controller
{
    /**
     * @return string|\yii\web\Response
     */
    public function actionRegister()
    {
        $model = new RegistrationForm();
        if ($model->load(\Yii::$app->request->post()) && $model->register()) {
            return $this->goHome();
        }
        return $this->render('register', [
            'model' => $model
        ]);
    }
}