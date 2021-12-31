<?php

namespace app\services\interfaces;

use app\models\Hotel;
use app\models\Rooms;

interface RoomServiceInterface
{
    /**
     * @param Hotel $hotel
     *
     * @return Rooms
     */
    public function getRoomsByHotel(Hotel $hotel): Rooms;
}
