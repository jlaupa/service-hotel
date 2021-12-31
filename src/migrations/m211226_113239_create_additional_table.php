<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%additional}}`.
 */
class m211226_113239_create_additional_table extends Migration
{
    public function safeUp(): void
    {
        $this->createTable('{{%additional}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'slug' => $this->string(),
            'created_at' => $this->dateTime()->defaultValue('now'),
            'updated_at' => $this->dateTime()->defaultValue('now'),
            'deleted_at' => $this->dateTime()->defaultValue(null),
            'deleted' => $this->boolean()->defaultValue(false),
        ]);
    }

    public function safeDown(): void
    {
        $this->dropTable('{{%additional}}');
    }
}
