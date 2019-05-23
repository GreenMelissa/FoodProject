<?php

namespace frontend\modules\builder\models;

use frontend\modules\builder\repositories\BranchRepository;
use yii\data\ActiveDataProvider;

/**
 * Class BranchSearch
 * @author Daniil Ilin <daniil.ilin@gmail.com>
 */
class BranchSearch extends Branch
{
    /**
     * Строка поиска
     * @var string
     */
    public $name;

    /**
     * @var BranchRepository
     */
    private $branchRepository;

    /**
     * SkillSearch constructor.
     * @param BranchRepository $branchRepository
     * @param array $config
     */
    public function __construct(BranchRepository $branchRepository, array $config = [])
    {
        $this->branchRepository = $branchRepository;
        parent::__construct($config);
    }

    /**
     * @return BranchRepository
     */
    public function getBranchRepository(): BranchRepository
    {
        return $this->branchRepository;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['name', 'string'],
        ];
    }

    /**
     * @param $params
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => $this->branchRepository->getActiveQuery(),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        if (!$this->load($params) || !$this->validate()) {
            return $dataProvider;
        }

        $dataProvider->query->andWhere([
            'OR',
            ['like', 'LOWER(name)', mb_strtolower($this->name)],
        ]);

        return $dataProvider;
    }
}