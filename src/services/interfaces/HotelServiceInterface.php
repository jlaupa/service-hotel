<?php

namespace app\services\interfaces;

use app\models\Hotel;
use yii\data\ActiveDataProvider;

interface HotelServiceInterface
{
    /**
     * @param int $hotelId
     *
     * @return Hotel
     */
    public function findOneById(int $hotelId): Hotel;
}
