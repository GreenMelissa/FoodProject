<?php

namespace frontend\modules\builder\models;

use yii\data\ActiveDataProvider;
use frontend\modules\builder\repositories\SkillRepository;

/**
 * Class SkillSearch
 * @package common\modules\builder\models
 * @author Daniil Ilin <daniil.ilin@gmail.com>
 */
class SkillSearch extends Skill
{
    /**
     * Строка поиска
     * @var string
     */
    public $name;

    /**
     * @var SkillRepository
     */
    private $skillRepository;

    /**
     * SkillSearch constructor.
     * @param SkillRepository $skillRepository
     * @param array $config
     */
    public function __construct(SkillRepository $skillRepository, array $config = [])
    {
        $this->skillRepository = $skillRepository;
        parent::__construct($config);
    }

    /**
     * @return SkillRepository
     */
    public function getSkillRepository(): SkillRepository
    {
        return $this->skillRepository;
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
            'query' => $this->skillRepository->getActiveQuery(),
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