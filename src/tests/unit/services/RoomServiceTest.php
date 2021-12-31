<?php

namespace app\tests\unit;

use app\exceptions\HotelNotFoundException;
use app\models\Hotel;
use app\models\Rooms;
use app\repositories\yiiorm\HotelRepository;
use app\repositories\yiiorm\RoomRepository;
use app\services\HotelService;
use app\services\RoomService;
use Codeception\Test\Unit;
use Exception;
use UnitTester;

class RoomServiceTest extends Unit
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
    public function testGetRoomsByHotelByHotelIdOk(): void
    {
        $hotelDataModel = new Hotel(['id' => self::HOTEL_ID]);
        $hotelRepository = $this->make(
            HotelRepository::class,
            ['findOne' => $hotelDataModel]
        );

        $hotelService = new HotelService($hotelRepository);

        $roomRepository = $this->make(
            RoomRepository::class,
            ['findBy' => new Rooms()]
        );

        $hotel = $hotelService->findOneById(self::HOTEL_ID);

        $roomService = new RoomService($roomRepository);

        $roomService->getRoomsByHotel($hotel);
    }

    /**
     * @throws Exception
     */
    public function testGetRoomsByHotelIdOkByHotelNotExist(): void
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

        $roomRepository = $this->make(
            RoomRepository::class,
            ['findBy' => new Rooms()]
        );

        $hotel = $hotelService->findOneById(self::NOT_EXISTENT_HOTEL_ID);

        $roomService = new RoomService($roomRepository);

        $roomService->getRoomsByHotel($hotel);
    }
}
