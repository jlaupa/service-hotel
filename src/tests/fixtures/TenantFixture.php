<?php

namespace app\tests\fixtures;

use app\models\TenantRoom;
use yii\test\ActiveFixture;

class TenantFixture extends ActiveFixture
{
    public $modelClass = TenantRoom::class;

    public $depends = [RoomFixture::class, UserFixture::class];
}
