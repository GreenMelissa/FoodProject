<?php


namespace common\validators;

use yii\validators\Validator;

/**
 * Class JsonValidator
 * @author Daniil Ilin <daniil.ilin@gmail.com>
 */
class JsonValidator extends Validator
{
    /**
     * @var string
     */
    public $notStringMessage;

    /**
     * @var string
     */
    public $invalidJsonMessage;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        if ($this->notStringMessage === null)
            $this->notStringMessage = \Yii::t('app', 'Значение должно быть строкой');

        if ($this->invalidJsonMessage === null)
            $this->invalidJsonMessage = \Yii::t('app', 'Значение должно быть валидным JSON. Ошибка - {errorMEssage}');
    }

    /**
     * @inheritdoc
     */
    protected function validateValue($value)
    {
        if (!is_string($value))
            return [$this->notStringMessage, []];

        json_decode($value);

        if (json_last_error())
            return [$this->invalidJsonMessage, ['errorMessage' => json_last_error_msg()]];

        return null;
    }
}