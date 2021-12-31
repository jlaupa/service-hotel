<?php

namespace app\repositories\yiiorm;

use app\exceptions\HotelNotFoundException;
use app\models\Hotel;
use app\repositories\interfaces\HotelRepositoryInterface;
use yii\data\ActiveDataProvider;

class HotelRepository implements HotelRepositoryInterface
{
    public function findBy(array $params): ActiveDataProvider
    {
        $query = Hotel::find();

        $dataProvider = new ActiveDataProvider(
            [
                'query' => $query,
                'sort' => [
                    'defaultOrder' => [
                        'id' => SORT_DESC,
                    ],
                ],
                'pagination' => [
                    'validatePage' => false,
                ],
            ]
        );

        $query->andWhere(['deleted' => false]);
        if (isset($params['id'])) {
            $query->andWhere(['id' => $params['id']]);
        }

        return $dataProvider;
    }

    /**
     * @param int $hotelId
     *
     * @return Hotel
     *
     * @throws HotelNotFoundException
     */
    public function findOne(int $hotelId):Hotel
    {
        $hotel = $this->findBy(['id' => $hotelId])->getModels();

        if (empty($hotel)) {
            throw new HotelNotFoundException($hotelId);
        }

        return current($hotel);
    }
}
