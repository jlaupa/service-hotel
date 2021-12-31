<?php

namespace app\models;

use DateTime;
use yii\behaviors\AttributeBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;


/**
 *
 * @property-read null|DateTime $createdAt
 * @property-read null|DateTime $deletedAt
 * @property-read null|DateTime $checkIn
 * @property-read string $fullAddress
 * @property-read null|DateTime $checkOut
 * @property-read null|string $email
 * @property-read int $id
 * @property-read string $name
 * @property-read null|string $phone
 * @property-read bool $deleted
 * @property-read null|string $score
 * @property-read ActiveQuery $bookedRooms
 * @property-read null|string $description
 * @property-read null|string $rating
 * @property-read null|string $link
 * @property-read ActiveQuery $rooms
 * @property-read null|DateTime $updatedAt
 */
class Hotel extends ActiveRecord
{

    public static function tableName(): string
    {
        return 'hotel';
    }

    public function behaviors(): array
    {
        return ArrayHelper::merge(
            parent::behaviors(),
            [
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
            ]
        );
    }

    public function rules(): array
    {
        return [
            [['deleted'], 'boolean'],
            [['score', 'rating'], 'double'],
            [['id'], 'number'],
            [['phone'], 'string'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['name', 'description'], 'string', 'max' => 255],
        ];
    }

    public function getId(): int
    {
        return $this->getAttribute('id');
    }

    public function getName(): string
    {
        return $this->getAttribute('name');
    }

    public function getPhone(): ?string
    {
        return $this->getAttribute('phone');
    }

    public function getEmail(): ?string
    {
        return $this->getAttribute('email');
    }

    public function getCheckIn(): ?DateTime
    {
        return $this->getAttribute('check_in');
    }

    public function getCheckOut(): ?DateTime
    {
        return $this->getAttribute('check_out');
    }

    public function getFullAddress(): string
    {
        return $this->getAttribute('full_address');
    }

    public function getLink(): ?string
    {
        return $this->getAttribute('link');
    }

    public function getScore(): ?string
    {
        return $this->getAttribute('score');
    }

    public function getRating(): ?string
    {
        return $this->getAttribute('rating');
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

    public function getRooms(): ActiveQuery
    {
        return $this->hasMany(Room::class, ['hotel_id' => 'id']);
    }

    public function getBookedRooms(): ActiveQuery
    {
        return $this->getRooms()->andWhere(
            [
                'state_id' => State::BOOKED_ID,
                'deleted' => false
            ]
        );
    }
}
