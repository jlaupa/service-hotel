<?php

namespace app\services;

use app\models\Hotel;
use app\repositories\interfaces\HotelRepositoryInterface;
use app\services\interfaces\HotelServiceInterface;

/**
 * Class Hotel service.
 */
class HotelService implements HotelServiceInterface
{
    /**
     * @var HotelRepositoryInterface
     */
    private $repository;

    public function __construct(
        HotelRepositoryInterface $repository
    ) {
        $this->repository = $repository;
    }

    /**
     * @param int $hotelId
     *
     * @return Hotel
     */
    public function findOneById(int $hotelId): Hotel
    {
        //business rules
        //...

        return $this->repository->findOne($hotelId);
    }
}
