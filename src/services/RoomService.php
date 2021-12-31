<?php

namespace app\services;


use app\models\Hotel;
use app\models\Rooms;
use app\repositories\interfaces\RoomRepositoryInterface;
use app\services\interfaces\RoomServiceInterface;

/**
 * Class Room service.
 */
class RoomService implements RoomServiceInterface
{
    /**
     * @var RoomRepositoryInterface
     */
    private $repository;

    /**
     * RoomService constructor.
     *
     * @param RoomRepositoryInterface $repository
     */
    public function __construct(RoomRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Hotel $hotel
     *
     * @return Rooms
     */
    public function getRoomsByHotel(Hotel $hotel): Rooms
    {
        //business rules
        //...

        return $this->repository->findBy(['hotel_id' => $hotel->getId()]);
    }
}
