<?php

namespace app\models;

use yii\behaviors\AttributeBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 *
 * @property-read ActiveQuery $user
 */
class TenantRoom extends ActiveRecord
{
    public static function tableName(): string
    {
        return 'tenant_room';
    }

    public function behaviors(): array
    {
        return ArrayHelper::merge(parent::behaviors(), [
            [
                'class' => AttributeBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'updated_at',
                    ActiveRecord::EVENT_AFTER_DELETE => 'deleted_at',
                ],
                'value' => function () {
                    return date(DATE_ATOM);
                },
            ],
        ]);
    }

    public function rules(): array
    {
        return [
            [['deleted'], 'boolean'],
            [['room_id', 'user_id', 'price_pay'], 'integer'],
            [['check_in', 'check_out', 'created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['name', 'description'], 'string', 'max' => 255],
        ];
    }

    public function getUser(): ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

}
