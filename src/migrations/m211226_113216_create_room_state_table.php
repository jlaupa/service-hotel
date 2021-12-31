<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%room_state}}`.
 */
class m211226_113216_create_room_state_table extends Migration
{
    public function safeUp(): void
    {
        $this->createTable(
            '{{%room_state}}',
            [
                'id' => $this->primaryKey(),
                'name' => $this->string()->unique()->notNull(),
                'deleted' => $this->boolean()->defaultValue(false),
            ]
        );
    }

    public function safeDown(): void
    {
        $this->dropTable('{{%room_state}}');
    }
}
