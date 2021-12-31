<?php

namespace app\services\interfaces;

use app\models\Hotel;
use app\models\User;
use app\models\Users;
use yii\data\ActiveDataProvider;

interface UserServiceInterface
{
    public function getUsersBookedByHotel(Hotel $hotel): Users;

    public function getUsersIdsByRooms(array $rooms): array;
}
