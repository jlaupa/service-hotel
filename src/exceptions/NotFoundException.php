<?php

namespace app\exceptions;

use yii\web\HttpException;

class NotFoundException extends HttpException
{
    public function __construct($message = null, $code = 0, \Exception $previous = null)
    {
        if (null == $message) {
            $message = \Yii::t('app/errors', $message);
        }

        parent::__construct(404, $message, $code, $previous);
    }
}
