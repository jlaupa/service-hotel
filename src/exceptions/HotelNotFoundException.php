<?php

namespace app\exceptions;
use yii\web\HttpException;

class HotelNotFoundException extends HttpException
{
    public function __construct(int $id, $message = null, $code = 0, \Exception $previous = null)
    {
        if (null === $message) {
            $message = \Yii::t('app/errors', "Hotel {$id} not found");
        }

        parent::__construct(404, $message, $code, $previous);
    }
}
