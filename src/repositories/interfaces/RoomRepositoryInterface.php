<?php

namespace app\repositories\interfaces;

use app\models\Hotel;
use app\models\Room;
use app\models\Rooms;
use yii\data\ActiveDataProvider;

interface RoomRepositoryInterface
{
    public function findBy(array $params) : Rooms;

    public function findOne(int $roomId) : ?Room;
}
