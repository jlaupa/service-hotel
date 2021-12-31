<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%room}}`.
 */
class m211226_113219_create_room_table extends Migration
{
    public function safeUp(): void
    {
        $this->createTable(
            '{{%room}}',
            [
                'id' => $this->primaryKey(),
                'hotel_id' => $this->integer()->unsigned()->notNull(),
                'name' => $this->string()->notNull(),
                'price' => $this->integer()->notNull(),
                'floor' => $this->tinyInteger(),
                'capacity' => $this->tinyInteger(),
                'port' => $this->tinyInteger(),
                'size' => $this->tinyInteger(),
                'free_cancellation' => $this->boolean()->defaultValue(false)->notNull(),
                'single_bed' => $this->tinyInteger(),
                'double_bed' => $this->tinyInteger(),
                'state_id' => $this->tinyInteger()
                    ->defaultValue(1)
                    ->comment('1available, 2offline, 3booked, 4rented'),
                'description' => $this->text(),
                'created_at' => $this->dateTime()->defaultValue('now'),
                'updated_at' => $this->dateTime()->defaultValue('now'),
                'deleted_at' => $this->dateTime()->defaultValue(null),
                'deleted' => $this->boolean()->defaultValue(false)->notNull(),
            ]
        );

        $this->addForeignKey(
            'fk-room-state_id',
            'room',
            'state_id',
            'room_state',
            'id'
        );

        $this->addForeignKey(
            'fk-hotel-hotel_id',
            'room',
            'hotel_id',
            'hotel',
            'id'
        );
    }

    public function safeDown(): void
    {
        $this->dropForeignKey('fk-hotel-hotel_id', 'room');
        $this->dropTable('{{%room}}');
    }
}
