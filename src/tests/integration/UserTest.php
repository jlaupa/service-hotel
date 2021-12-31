<?php

namespace app\tests\integration;

use app\exceptions\HotelNotFoundException;
use app\models\Hotel;
use app\services\HotelService;
use app\services\UserService;
use app\tests\fixtures\HotelFixture;
use app\tests\fixtures\RoomFixture;
use app\tests\fixtures\TenantFixture;
use app\tests\fixtures\UserFixture;
use Codeception\Test\Unit;
use IntegrationTester;
use Yii;

class UserTest extends Unit
{
    private const NOT_EXISTENT_HOTEL_ID = 9999;
    private const TOTAL_USERS = 1;
    private const TOTAL_USERS_EMPTY = 0;

    /**
     * @var IntegrationTester
     */
    protected $tester;
    
    /**
     * @var HotelService
     */
    private $hotelService;

    /**
     * @var UserService
     */
    private $userService;

    protected function _before(): void
    {
        $this->hotelService = Yii::$container->get(HotelService::class);
        $this->userService = Yii::$container->get(UserService::class);
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
            'user' => [
                'class' => UserFixture::class,
                'dataFile' => codecept_data_dir().'user.php',
            ],
            'tenant' => [
                'class' => TenantFixture::class,
                'dataFile' => codecept_data_dir().'tenant.php',
            ],
        ];
    }

    public function testGetUsersByHotelOK(): void
    {
        /** @var HotelFixture $hotelFixture */
        $hotelFixture = $this->tester->grabFixture('hotel');

        /** @var Hotel $hotel */
        $hotel = $hotelFixture->getModel('hotel');
        
        $hotel = $this->hotelService->findOneById($hotel->getId());
        $users = $this->userService->getUsersBookedByHotel($hotel);

        self::assertEquals(self::TOTAL_USERS, $users->getTotalCount());
    }

    public function testGetUsersByHotelOKByUsersEmpty(): void
    {
        /** @var HotelFixture $hotelFixture */
        $hotelFixture = $this->tester->grabFixture('hotel');

        /** @var Hotel $hotel */
        $hotel = $hotelFixture->getModel('hotel_empty');

        $hotel = $this->hotelService->findOneById($hotel->getId());
        $users = $this->userService->getUsersBookedByHotel($hotel);

        self::assertEquals(self::TOTAL_USERS_EMPTY, $users->getTotalCount());
    }

    public function testGetUsersByHotelNotOKByHotelNotFound(): void
    {
        $this->expectException(HotelNotFoundException::class);
        $this->expectErrorMessage(sprintf('Hotel %u not found', self::NOT_EXISTENT_HOTEL_ID));

        $hotel = $this->hotelService->findOneById(self::NOT_EXISTENT_HOTEL_ID);

        $this->userService->getUsersByHotel($hotel);
    }
}
