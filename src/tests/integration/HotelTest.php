<?php

namespace app\tests\integration;

use app\exceptions\HotelNotFoundException;
use app\services\HotelService;
use app\tests\fixtures\HotelFixture;
use Codeception\Test\Unit;
use IntegrationTester;
use Yii;

class HotelTest extends Unit
{
    private const HOTEL_ID = 1;
    private const NOT_EXISTENT_HOTEL_ID = 9999;

    /**
     * @var IntegrationTester
     */
    protected $tester;


    /**
     * @var HotelService
     */
    private $hotelService;

    protected function _before(): void
    {
        $this->hotelService = Yii::$container->get(HotelService::class);
    }

    public function _fixtures(): array
    {
        return [
            'hotel' => [
                'class' => HotelFixture::class,
                'dataFile' => codecept_data_dir().'hotel.php',
            ],
        ];
    }

    public function testFindOneByIdOK(): void
    {
        $hotel = $this->hotelService->findOneById(self::HOTEL_ID);

        self::assertEquals(self::HOTEL_ID, $hotel->getId());
    }

    public function testFindHotelsNotOKByHotelNotFound(): void
    {
        $this->expectException(HotelNotFoundException::class);
        $this->expectErrorMessage(sprintf('Hotel %u not found', self::NOT_EXISTENT_HOTEL_ID));

        $this->hotelService->findOneById(self::NOT_EXISTENT_HOTEL_ID);
    }
}
