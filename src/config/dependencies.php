<?php
use app\repositories\interfaces\HotelRepositoryInterface;
use app\repositories\interfaces\RoomRepositoryInterface;
use app\repositories\interfaces\UserRepositoryInterface;
use app\repositories\yiiorm\HotelRepository;
use app\repositories\yiiorm\RoomRepository;
use app\repositories\yiiorm\UserRepository;
use app\services\HotelService;
use app\services\interfaces\HotelServiceInterface;
use app\services\interfaces\RoomServiceInterface;
use app\services\interfaces\UserServiceInterface;
use app\services\RoomService;
use app\services\UserService;


$container = Yii::$container;

$container->setSingleton(HotelServiceInterface::class, HotelService::class);
$container->setSingleton(HotelRepositoryInterface::class, HotelRepository::class);

$container->setSingleton(RoomServiceInterface::class, RoomService::class);
$container->setSingleton(RoomRepositoryInterface::class, RoomRepository::class);

$container->setSingleton(UserServiceInterface::class, UserService::class);
$container->setSingleton(UserRepositoryInterface::class, UserRepository::class);

