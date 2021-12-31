<?php

namespace app\tests\unit;

use app\exceptions\HotelNotFoundException;
use app\models\Hotel;
use app\models\Users;
use app\repositories\yiiorm\HotelRepository;
use app\repositories\yiiorm\UserRepository;
use app\services\HotelService;
use app\services\UserService;
use Codeception\Test\Unit;
use Exception;
use UnitTester;

class UserServiceTest extends Unit
{
    // all const are fake data to describe the field
    private const NOT_EXISTENT_HOTEL_ID = 9999;
    private const HOTEL_ID = 1;

    /**
     * @var UnitTester
     */
    protected $tester;

    /**
     * @throws Exception
     */
    public function testGetUsersBookedByHotelIdOk(): void
    {
        $hotelDataModel = new Hotel(['id' => self::HOTEL_ID]);
        $hotelRepository = $this->make(
            HotelRepository::class,
            ['findOne' => $hotelDataModel]
        );

        $hotelService = new HotelService($hotelRepository);

        $userRepository = $this->make(
            UserRepository::class,
            ['findBy' => new Users()]
        );

        $hotel = $hotelService->findOneById(self::HOTEL_ID);

        $userService = new UserService($userRepository);

        $userService->getUsersBookedByHotel($hotel);
    }

    /**
     * @throws Exception
     */
    public function testGetUsersBookedByHotelIdOkByHotelNotExist(): void
    {
        $this->expectException(HotelNotFoundException::class);

        $hotelRepository = $this->make(
            HotelRepository::class,
            [
                'findOne' => function () {
                    throw new HotelNotFoundException(self::NOT_EXISTENT_HOTEL_ID);
                },
            ]
        );

        $hotelService = new HotelService($hotelRepository);

        $userRepository = $this->make(
            UserRepository::class,
            ['findBy' => new Users()]
        );

        $hotel = $hotelService->findOneById(self::HOTEL_ID);

        $userService = new UserService($userRepository);

        $userService->getUsersBookedByHotel($hotel);
    }
}
