<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%room_photo}}`.
 */
class m211226_113251_create_room_photo_table extends Migration
{
    public function safeUp(): void
    {
        $this->createTable(
            '{{%room_photo}}',
            [
                'id' => $this->primaryKey(),
                'room_id' => $this->bigInteger()->unsigned()->notNull(),
                'link' => $this->string()->notNull(),
                'order' => $this->integer(),
                'created_at' => $this->dateTime()->defaultValue('now'),
                'updated_at' => $this->dateTime()->defaultValue('now'),
                'deleted_at' => $this->dateTime()->defaultValue(null),
                'deleted' => $this->boolean()->defaultValue(false),
            ]
        );

        $this->addForeignKey(
            'fk-room_photo-room_id',
            'room_photo',
            'room_id',
            'room',
            'id'
        );
    }

    public function safeDown(): void
    {
        $this->dropForeignKey('fk-room_photo-room_id', 'room_photo');
        $this->dropTable('{{%room_photo}}');
    }
}
