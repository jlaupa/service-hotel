<?php

namespace app\services;

use app\models\Hotel;
use app\models\Users;
use app\repositories\interfaces\UserRepositoryInterface;
use app\services\interfaces\UserServiceInterface;
use yii\helpers\ArrayHelper;

/**
 * Class User service.
 */
class UserService implements UserServiceInterface
{
    /**
     * @var UserRepositoryInterface
     */
    private $repository;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getUsersBookedByHotel(Hotel $hotel): Users
    {
        $rooms = $hotel->getBookedRooms()->all();
        $userIds = $this->getUsersIdsByRooms($rooms);

        return $this->repository->findBy([
            'id' => $userIds
        ]);
    }

    public function getUsersIdsByRooms(array $rooms): array
    {
        $userIds = [];
        foreach ($rooms as $room) {
            $tenants = $room->getTenants()->all();
            $userIds[] = ArrayHelper::getColumn($tenants, 'user_id');
        }

        if (!empty($userIds)) {
            return array_merge(...array_values($userIds));
        }

        return $userIds;
    }
}
