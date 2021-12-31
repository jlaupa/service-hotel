<?php

namespace app\tests\fixtures;

use app\models\Hotel;
use app\models\Room;
use yii\test\ActiveFixture;

class RoomFixture extends ActiveFixture
{
    public $modelClass = Room::class;

    public $depends = [HotelFixture::class];

}
