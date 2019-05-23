<?php

namespace frontend\modules\builder\service;

use frontend\modules\builder\forms\BuildForm;
use frontend\modules\builder\models\Build;
use frontend\modules\builder\models\Skill;
use yii\db\JsonExpression;
use yii\helpers\Json;

/**
 * Class BuilderService
 * @author Daniil Ilin <daniil.ilin@gmail.com>
 */
class BuilderService
{
    /**
     * @var array
     */
    public $skillBar;

    /**
     * @var BuildForm
     */
    public $buildForm;

    /**
     * BuilderService constructor.
     */
    public function __construct()
    {
        $this->buildForm = \Yii::createObject(BuildForm::class);
    }

    /**
     * @return BuildForm
     */
    public function getBuildForm(): BuildForm
    {
        return $this->buildForm;
    }

    /**
     * @param array $skillIds
     * @return bool|string
     */
    public function createSkillBarData(array $skillIds)
    {
        if (count($skillIds) > 6) {
            return false;
        }
        foreach ($skillIds as $skillId) {
            if ($skillId > 0) {
                continue;
            } else {
                return false;
            }
        }
        $this->skillBar = Json::encode($skillIds);
        return true;
    }

    /**
     * @return bool
     */
    public function createBuild()
    {
        if ($this->getBuildForm()->validate()) {
            $transaction = \Yii::$app->db->beginTransaction();
            try {
                $this->getBuildForm()->save();
                $transaction->commit();
                return true;
            } catch (\Throwable $exception) {
                $transaction->rollBack();
                throw $exception;
            }
        } else {
            return false;
        }
    }
}