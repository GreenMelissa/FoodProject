<?php

namespace backend;

/**
 * Базовый контроллер для бэкенда.
 * @author Daniil Ilin <daniil.ilin@gmail.com>
 */
class BackendController extends \yii\web\Controller
{
    /**
     * @var string
     */
    public $layout = '@backend/views/layouts/main';
}