<?php

namespace backend\modules\skill\controllers;

use backend\BackendController;
use backend\BackendModule;
use backend\modules\skill\service\SkillService;
use frontend\modules\builder\models\Skill;
use frontend\modules\builder\models\SkillSearch;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;

/**
 * Class SkillManageController
 * @package backend\modules\admin\controllers
 * @author Daniil Ilin <daniil.ilin@gmail.com>
 */
class SkillManageController extends BackendController
{
    /**
     * @var SkillSearch
     */
    private $skillSearch;

    /**
     * SkillManageController constructor.
     * @param string $id
     * @param \yii\base\Module $module
     * @param SkillSearch $skillSearch
     * @param array $config
     */
    public function __construct($id, $module, SkillSearch $skillSearch, array $config = [])
    {
        $this->skillSearch = $skillSearch;
        parent::__construct($id, $module, $config);
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'accessControl' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => [BackendModule::PERM_INDEX_SKILL],
                    ],
                    [
                        'actions' => ['create', 'update', 'delete'],
                        'allow' => true,
                        'roles' => [BackendModule::PERM_MANAGE_SKILL],
                    ],
                ],
            ],
        ];
    }

    /**
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index', [
            'searchModel' => $this->skillSearch,
            'dataProvider' => $this->skillSearch->search(\Yii::$app->request->queryParams)
        ]);
    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $skillService = new SkillService();

        if ($skillService->getSkill()->load(post()) && $skillService->process()) {
            \Yii::$app->session->setFlash('success', 'Навык успешно создан');
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'service' => $skillService,
        ]);
    }

    /**
     * @param int $id
     * @return string|\yii\web\Response
     */
    public function actionUpdate(int $id)
    {
        $skillService = new SkillService($this->findModel($id));

        if ($skillService->getSkill()->load(post()) && $skillService->process()) {
            \Yii::$app->session->setFlash('success', 'Навык успешно отредактирован');
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'service' => $skillService,
        ]);
    }

    /**
     * @param int $id
     * @return \yii\web\Response
     */
    public function actionDelete(int $id)
    {
        $skill = $this->findModel($id);

        if ($skill->delete()) {
            \Yii::$app->session->setFlash('success', 'Навык успешно удален');
            return $this->redirect(['index']);
        } else {
            \Yii::$app->session->setFlash('danger', 'Не удалось удалить навык');
            return $this->redirect(['index']);
        }
    }

    /**
     * @param int $id
     * @return Skill|null
     * @throws NotFoundHttpException
     */
    public function findModel(int $id)
    {
        $skill = $this->skillSearch->getSkillRepository()->findById($id);

        if (!$skill) {
            throw new NotFoundHttpException();
        }

        return $skill;
    }
}