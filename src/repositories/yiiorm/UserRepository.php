<?php

namespace app\repositories\yiiorm;

use app\exceptions\UserNotFoundException;
use app\models\User;
use app\models\Users;
use app\repositories\interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function findBy(array $params): Users
    {
        $query = User::find();

        $users = new Users(
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

        return $users ;
    }

    /**
     * @param int $userId
     *
     * @return User
     *
     * @throws UserNotFoundException
     */
    public function findOne(int $userId):User
    {
        $user = $this->findBy(['id' => $userId])->getModels();

        if (empty($user)) {
            throw new UserNotFoundException($userId);
        }

        return current($user);
    }
}
