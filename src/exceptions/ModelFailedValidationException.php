<?php

namespace app\exceptions;
use yii\web\HttpException;

class ModelFailedValidationException extends HttpException
{
    public function __construct($message = null, $code = 0, \Exception $previous = null)
    {
        if (null === $message) {
            $message = \Yii::t('app/errors', 'validation failed');
        }

        parent::__construct(400, $message, $code, $previous);
    }
}
