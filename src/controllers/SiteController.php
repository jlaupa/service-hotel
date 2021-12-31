<?php

namespace app\controllers;

use CommunicationUser\components\RestController;
use yii\web\Response;

class SiteController extends \yii\rest\ActiveController
{
    public $modelClass = 'app\models\Event';

    /**
     * @return array
     */
    public function behaviors()
    {
        $customBehaviors = [
            'contentNegotiator' => [
                'class' => 'yii\filters\ContentNegotiator',
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                ],
            ],
        ];

        return array_merge(
            $customBehaviors
        );
    }

    public function actions()
    {
        return [
            'error' => ['class' => 'yii\web\ErrorAction'],
        ];
    }

    public function actionError()
    {
        return $this->render('error');
    }
}
