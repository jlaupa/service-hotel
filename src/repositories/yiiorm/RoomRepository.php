<?php

namespace app\repositories\yiiorm;

use app\exceptions\RoomNotFoundException;
use app\models\Room;
use app\models\Rooms;
use app\repositories\interfaces\RoomRepositoryInterface;

class RoomRepository implements RoomRepositoryInterface
{
    /**
     * @param array $params
     *
     * @return Rooms
     */
    public function findBy(array $params): Rooms
    {
        $query = Room::find();

        $rooms = new Rooms(
            [
                'query' => $query,
                'sort' => [
                    'defaultOrder' => [
                        'id' => SORT_DESC,
                    ],
                ],
                'pagination' => [
                    'validatePage' => true,
                ],
            ]
        );

        $query->andWhere(['deleted' => false]);
        if (isset($params['id'])) {
            $query->andWhere(['id' => $params['id']]);
        }

        if (isset($params['hotel_id'])) {
            $query->andWhere(['hotel_id' => $params['hotel_id']]);
        }

        return $rooms;
    }

    /**
     * @param int $roomId
     *
     * @return Room|null
     *
     * @throws RoomNotFoundException
     */
    public function findOne(int $roomId): ?Room
    {
        $room = $this->findBy(['id' => $roomId])->getModels();

        if (empty($room)) {
            throw new RoomNotFoundException($roomId);
        }

        return current($room);
    }
}
