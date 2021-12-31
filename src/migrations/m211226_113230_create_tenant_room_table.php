<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%tenant_room}}`.
 */
class m211226_113230_create_tenant_room_table extends Migration
{
    public function safeUp(): void
    {
        $this->createTable('{{%tenant_room}}', [
            'id' => $this->primaryKey(),
            'room_id' => $this->integer()->unsigned()->notNull(),
            'user_id' => $this->integer()->unsigned()->notNull(),
            'price_pay' => $this->integer(),
            'amount_people' => $this->integer(),
            'check_in' => $this->date()->notNull(),
            'check_out' => $this->date()->notNull(),
            'observations' => $this->text(),
            'created_at' => $this->dateTime()->defaultValue('now'),
            'updated_at' => $this->dateTime()->defaultValue('now'),
            'deleted_at' => $this->dateTime()->defaultValue(null),
            'deleted' => $this->boolean()->defaultValue(false),
        ]);

        $this->addForeignKey(
            'fk-tenant-room-room_id',
            'tenant_room',
            'room_id',
            'room',
            'id'
        );

        $this->addForeignKey(
            'fk-tenant-room-user_id',
            'tenant_room',
            'user_id',
            'user',
            'id'
        );
    }

    public function safeDown(): void
    {
        $this->dropForeignKey('fk-tenant-room-user_id', 'tenant_room');
        $this->dropForeignKey('fk-tenant-room-room_id', 'tenant_room');
        $this->dropTable('{{%tenant_room}}');
    }
}
