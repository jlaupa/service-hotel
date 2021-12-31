<?php

namespace app\controllers;

use app\models\Hotel;
use app\models\Rooms;
use app\models\Users;
use app\services\interfaces\HotelServiceInterface;
use app\services\interfaces\RoomServiceInterface;
use app\services\interfaces\UserServiceInterface;
use yii\web\Request;

class HotelController extends BaseController
{
    /**
     * @var string
     */
    public $modelClass = Hotel::class;

    /**
     * REST Actions.
     *
     * @return array
     */
    public function actions(): array
    {
        $actions = parent::actions();
        unset($actions['view'], $actions['search'],);

        return $actions;
    }

    public function actionView(
        HotelServiceInterface $hotelService,
        Request $request
    ): ?Hotel {
        $hotelId = $request->getQueryParam('hotel_id');

        return $hotelService->findOneById($hotelId);
    }

    public function actionSearchRooms(
        RoomServiceInterface $roomService,
        HotelServiceInterface $hotelService,
        Request $request
    ): ?Rooms  {
        $hotelId = $request->getQueryParam('hotel_id');
        $hotel = $hotelService->findOneById($hotelId);

        return $roomService->getRoomsByHotel($hotel);
    }

    public function actionUsersBooked(
        UserServiceInterface $userService,
        HotelServiceInterface $hotelService,
        Request $request
    ): Users {
        $hotelId = $request->getQueryParam('hotel_id');

        $hotel = $hotelService->findOneById($hotelId);

        return $userService->getUsersBookedByHotel($hotel);
    }
}
