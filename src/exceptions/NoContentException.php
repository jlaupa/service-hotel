<?php

namespace app\exceptions;

use yii\web\HttpException;

class NoContentException extends HttpException
{
    public function __construct($message = null, $code = 0, \Exception $previous = null)
    {
        if (null == $message) {
            $message = \Yii::t('app/errors', $message);
        }

        parent::__construct(204, $message, $code, $previous);
    }
}
