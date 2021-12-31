<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%hotels}}`.
 */
class m211226_113214_create_hotel_table extends Migration
{
    public function safeUp(): void
    {
        $this->createTable(
            '{{%hotel}}',
            [
                'id' => $this->primaryKey(),
                'name' => $this->string()->notNull(),
                'phone' => $this->string(20),
                'email' => $this->string(240),
                'check_in' => $this->time(),
                'check_out' => $this->time(),
                'full_address' => $this->string(240)->notNull(),
                'link' => $this->string(),
                'score' => $this->float(2),
                'rating' => $this->float(2),
                'description' => $this->text(),
                'created_at' => $this->dateTime()->defaultValue('now'),
                'updated_at' => $this->dateTime()->defaultValue('now'),
                'deleted_at' => $this->dateTime()->defaultValue(null),
                'deleted' => $this->boolean()->defaultValue(false),
            ]
        );
    }

    public function safeDown(): void
    {
        $this->dropTable('{{%hotels}}');
    }
}
