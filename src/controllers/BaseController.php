<?php

namespace app\controllers;
use yii\filters\RateLimiter;
use yii\rest\ActiveController;
use yii\web\Response;

/**
 * Class BaseController.
 */
class BaseController extends ActiveController
{
    /**
     * @return array
     */
    public function behaviors(): array
    {
        return [
            'contentNegotiator' => [
                'class' => 'yii\filters\ContentNegotiator',
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                ],
            ],
            'rateLimiter' => [
                'class' => RateLimiter::class,
            ],
        ];
    }

    /**
     * @return array
     */
    public function actionLogin(): array
    {
        return ['isValid' => true];
    }
}
