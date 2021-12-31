<?php

namespace app\tests\integration;

use app\exceptions\HotelNotFoundException;
use app\models\Hotel;
use app\services\HotelService;
use app\services\RoomService;
use app\tests\fixtures\HotelFixture;
use app\tests\fixtures\RoomFixture;
use Codeception\Test\Unit;
use IntegrationTester;
use Yii;

class RoomTest extends Unit
{
    private const NOT_EXISTENT_HOTEL_ID = 9999;
    private const TOTAL_ROOMS = 4;
    private const TOTAL_ROOMS_EMPTY = 0;

    /**
     * @var IntegrationTester
     */
    protected $tester;


    /**
     * @var HotelService
     */
    private $hotelService;

    /**
     * @var RoomService
     */
    private $roomService;

    protected function _before(): void
    {
        $this->hotelService = Yii::$container->get(HotelService::class);
        $this->roomService = Yii::$container->get(RoomService::class);
    }

    public function _fixtures(): array
    {
        return [
            'hotel' => [
                'class' => HotelFixture::class,
                'dataFile' => codecept_data_dir().'hotel.php',
            ],
            'room' => [
                'class' => RoomFixture::class,
                'dataFile' => codecept_data_dir().'room.php',
            ],
        ];
    }

    public function testGetRoomsByHotelOK(): void
    {
        /** @var HotelFixture $hotelFixture */
        $hotelFixture = $this->tester->grabFixture('hotel');

        /** @var Hotel $hotel */
        $hotel = $hotelFixture->getModel('hotel');
        
        $hotel = $this->hotelService->findOneById($hotel->getId());
        $rooms = $this->roomService->getRoomsByHotel($hotel);

        self::assertEquals(self::TOTAL_ROOMS, $rooms->getTotalCount());
    }

    public function testGetRoomsByHotelOKByRoomsEmpty(): void
    {
        /** @var HotelFixture $hotelFixture */
        $hotelFixture = $this->tester->grabFixture('hotel');

        /** @var Hotel $hotel */
        $hotel = $hotelFixture->getModel('hotel_empty');

        $hotel = $this->hotelService->findOneById($hotel->getId());
        $rooms = $this->roomService->getRoomsByHotel($hotel);

        self::assertEquals(self::TOTAL_ROOMS_EMPTY, $rooms->getTotalCount());
    }

    public function testGetRoomsByHotelNotOKByHotelNotFound(): void
    {
        $this->expectException(HotelNotFoundException::class);
        $this->expectErrorMessage(sprintf('Hotel %u not found', self::NOT_EXISTENT_HOTEL_ID));

        $hotel = $this->hotelService->findOneById(self::NOT_EXISTENT_HOTEL_ID);

        $this->roomService->getRoomsByHotel($hotel);
    }
}
