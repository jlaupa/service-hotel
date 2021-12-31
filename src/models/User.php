<?php

namespace app\models;

use DateTime;
use yii\behaviors\AttributeBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

class User extends ActiveRecord
{
    private $id;
    private $name;
    private $created_at;
    private $updated_at;
    private $deleted_at;
    private $deleted;

    public static function tableName(): string
    {
        return 'user';
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
            [['size', 'price', 'phone'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['name', 'description'], 'string', 'max' => 255],
        ];
    }

    public function getState(): ActiveQuery
    {
        return $this->hasOne(State::class, ['id' => 'state_id']);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCreatedAt(): ?DateTime
    {
        return $this->created_at;
    }

    public function getUpdatedAt(): ?DateTime
    {
        return $this->updated_at;
    }

    public function getDeletedAt(): ?DateTime
    {
        return $this->deleted_at;
    }

    public function getDeleted(): bool
    {
        return $this->deleted;
    }
}
