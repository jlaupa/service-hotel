<?php

namespace app\tests\unit;

use app\exceptions\HotelNotFoundException;
use app\models\Hotel;
use app\repositories\yiiorm\HotelRepository;
use app\services\HotelService;
use Codeception\Test\Unit;
use Exception;
use UnitTester;

class HotelServiceTest extends Unit
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
    public function testFindOneHotelByIdOk(): void
    {
        $hotelRepository = $this->make(
            HotelRepository::class,
            ['findOne' => new Hotel()]
        );

        $service = new HotelService($hotelRepository);

        $service->findOneById(self::HOTEL_ID);
    }

    /**
     * @throws Exception
     */
    public function testFindOneHotelByIdNotOkByHotelNotExist(): void
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

        $service = new HotelService($hotelRepository);

        $service->findOneById(self::NOT_EXISTENT_HOTEL_ID);
    }
}
