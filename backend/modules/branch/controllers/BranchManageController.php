<?php

namespace backend\modules\branch\controllers;

use backend\BackendController;
use backend\modules\branch\service\BranchService;
use frontend\modules\builder\models\Branch;
use frontend\modules\builder\models\BranchSearch;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\BackendModule;
use yii\web\NotFoundHttpException;

/**
 * Class BranchManageController
 * @author Daniil Ilin <daniil.ilin@gmail.com>
 */
class BranchManageController extends BackendController
{
    /**
     * @var BranchSearch
     */
    private $branchSearch;

    /**
     * SkillManageController constructor.
     * @param string $id
     * @param \yii\base\Module $module
     * @param BranchSearch $branchSearch
     * @param array $config
     */
    public function __construct($id, $module, BranchSearch $branchSearch, array $config = [])
    {
        $this->branchSearch = $branchSearch;
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
                        'roles' => [BackendModule::PERM_INDEX_BRANCH],
                    ],
                    [
                        'actions' => ['create', 'update', 'delete'],
                        'allow' => true,
                        'roles' => [BackendModule::PERM_MANAGE_BRANCH],
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
            'searchModel' => $this->branchSearch,
            'dataProvider' => $this->branchSearch->search(\Yii::$app->request->queryParams)
        ]);
    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $branchService = new BranchService();

        if ($branchService->getBranch()->load(post()) && $branchService->process()) {
            \Yii::$app->session->setFlash('success', 'Ветка успешно создана');
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'service' => $branchService,
        ]);
    }

    /**
     * @param int $id
     * @return string|\yii\web\Response
     */
    public function actionUpdate(int $id)
    {
        $branchService = new BranchService($this->findModel($id));

        if ($branchService->getBranch()->load(post()) && $branchService->process()) {
            \Yii::$app->session->setFlash('success', 'Ветка успешно отредактирована');
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'service' => $branchService,
        ]);
    }

    /**
     * @param int $id
     * @return \yii\web\Response
     */
    public function actionDelete(int $id)
    {
        $branch = $this->findModel($id);

        if ($branch->delete()) {
            \Yii::$app->session->setFlash('success', 'Ветка успешно удалена');
            return $this->redirect(['index']);
        } else {
            \Yii::$app->session->setFlash('danger', 'Не удалось удалить ветку');
            return $this->redirect(['index']);
        }
    }

    /**
     * @param int $id
     * @return Branch|null
     * @throws NotFoundHttpException
     */
    public function findModel(int $id)
    {
        $branch = $this->branchSearch->getBranchRepository()->findById($id);

        if (!$branch) {
            throw new NotFoundHttpException();
        }

        return $branch;
    }
}