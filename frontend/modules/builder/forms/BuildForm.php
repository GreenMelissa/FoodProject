<?php

namespace frontend\modules\builder\forms;

use frontend\modules\builder\models\Build;
use frontend\modules\builder\models\Skill;
use yii\helpers\Json;

/**
 * Class BuildForm
 * @author Daniil Ilin <daniil.ilin@gmail.com>
 */
class BuildForm extends Build
{
    const STATS_MAX_SUM     = 64;
    const MAX_SKILLS_NUMBER = 5;

    /**
     * @param array $data
     * @param null $formName
     * @return bool
     */
    public function load($data, $formName = null)
    {
        if (!empty($data)) {
            $skills = [];
            for ($i = 1; $i <= self::MAX_SKILLS_NUMBER; $i++) {
                $skills['skill-' . $i] = $data['skill-' . $i];
            }
            $this->skill_bar = $skills;
        }
        return parent::load($data, $formName);
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            ['skill_bar', 'validateSkills'],
            ['name', 'string'],
        ];
    }

    /**
     * @return bool
     */
    public function validateSkills()
    {
        if (!$this->skill_bar) {
            return false;
        }
        foreach ($this->skill_bar as $id) {
            if ($id && !Skill::find()->byId($id)->exists()) {
                $this->addError('skill_bar', 'Выбран несуществующий навык');
            }
        }
        return true;
    }

    /**
     * @return bool
     */
    public function validateStats()
    {
        if ($this->magicka >= 0 && $this->stamina >= 0 && $this->strength >= 0 &&
        $this->magicka !== null && $this->stamina !== null && $this->strength !== null) {
            return ($this->magicka + $this->stamina + $this->strength) > self::STATS_MAX_SUM ? false : true;
        } else {
            return false;
        }
    }
}