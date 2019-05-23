<?php

namespace frontend\controllers;

use frontend\modules\builder\forms\BuildForm;
use frontend\modules\builder\repositories\BranchRepository;
use frontend\modules\builder\repositories\SkillRepository;
use frontend\modules\builder\service\BuilderService;
use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\modules\user\repositories\StatisticRepository;
use yii\base\Module;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @var StatisticRepository
     */
    public $statisticRepository;

    /**
     * SiteController constructor.
     * @param string $id
     * @param Module $module
     * @param StatisticRepository $statisticRepository
     * @param array $config
     */
    public function __construct($id, Module $module, StatisticRepository $statisticRepository, array $config = [])
    {
        $this->statisticRepository = $statisticRepository;
        parent::__construct($id, $module, $config);
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $service = \Yii::createObject(BuilderService::class);

        if ($service->getBuildForm()->load(post()) && $service->createBuild()) {
            \Yii::$app->session->setFlash('success', 'Билд успешно создан');
            return $this->redirect(['/builder/build/view', 'id' => $service->getBuildForm()->id]);
        }

        return $this->render('index', [
            'skillList' => (new SkillRepository())->getSkillList(),
            'branchTree' => (new BranchRepository())->getBranchTree(),
            'model' => $service->getBuildForm(),
        ]);
    }
}
