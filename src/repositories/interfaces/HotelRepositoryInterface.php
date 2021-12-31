<?php

namespace app\repositories\interfaces;

use app\models\Hotel;
use yii\data\ActiveDataProvider;

interface HotelRepositoryInterface
{
    public function findBy(array $params) : ActiveDataProvider;

    public function findOne(int $hotelId) : ?Hotel;
}
