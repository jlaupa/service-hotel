<?php

namespace app\models;

use DateTime;
use yii\behaviors\AttributeBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 *
 * @property-read null|int $doubleBed
 * @property-read null|int $stateId
 * @property-read int $hotelId
 * @property-read null|bool $freeCancellation
 * @property-read null|DateTime $createdAt
 * @property-read null|DateTime $deletedAt
 * @property-read null|int $singleBed
 * @property-read ActiveQuery $state
 * @property-read ActiveQuery $tenants
 * @property-read null|DateTime $updatedAt
 */
class Room extends ActiveRecord
{
    public static function tableName(): string
    {
        return 'room';
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
            [['name'], 'required'],
            [['deleted'], 'boolean'],
            [['size', 'price'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['name', 'description', 'phone'], 'string', 'max' => 255],
        ];
    }

    public function fields(): array
    {
        $fields = parent::fields();
        $this->addStateField($fields);

        return $fields;
    }

    public function addStateField(array &$fields): void
    {
        unset($fields['state_id']);
        $fields['state'] = static function ($model) {
            return $model->state;
        };
    }

    public function getTenants(): ActiveQuery
    {
        return $this->hasMany(TenantRoom::class, ['room_id' => 'id']);
    }

    public function getState(): ActiveQuery
    {
        return $this->hasOne(State::class, ['id' => 'state_id']);
    }

    public function getId(): int
    {
        return $this->getAttribute('id');
    }

    public function getHotelId(): int
    {
        return $this->getAttribute('hotel_id');
    }

    public function getName(): string
    {
        return $this->getAttribute('name');
    }

    public function getPrice(): int
    {
        return $this->getAttribute('price');
    }

    public function getFloor(): ?int
    {
        return $this->getAttribute('floor');
    }

    public function getCapacity(): ?int
    {
        return $this->getAttribute('capacity');
    }

    public function getPort(): ?int
    {
        return $this->getAttribute('port');
    }

    public function getSize(): ?int
    {
        return $this->getAttribute('size');
    }

    public function getFreeCancellation(): ?bool
    {
        return $this->getAttribute('free_cancellation');
    }

    public function getSingleBed(): ?int
    {
        return $this->getAttribute('single_bed');
    }

    public function getDoubleBed(): ?int
    {
        return $this->getAttribute('double_bed');
    }

    public function getStateId(): ?int
    {
        return $this->getAttribute('state_id');
    }

    public function getDescription(): ?string
    {
        return $this->getAttribute('description');
    }

    public function getCreatedAt(): ?DateTime
    {
        return $this->getAttribute('created_at');
    }

    public function getUpdatedAt(): ?DateTime
    {
        return $this->getAttribute('updated_at');
    }

    public function getDeletedAt(): ?DateTime
    {
        return $this->getAttribute('deleted_at');
    }

    public function getDeleted(): bool
    {
        return $this->getAttribute('deleted');
    }
}
