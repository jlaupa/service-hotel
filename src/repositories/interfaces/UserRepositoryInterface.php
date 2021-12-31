<?php

namespace app\repositories\interfaces;

use app\models\User;
use app\models\Users;

interface UserRepositoryInterface
{
    public function findBy(array $params) : Users;

    public function findOne(int $userId) : ?User;

}
