<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m211226_113226_create_user_table extends Migration
{
    public function safeUp(): void
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'last_name' => $this->string(),
            'phone' => $this->string(20),
            'country' => $this->string(),
            'email' => $this->string()->notNull()->unique(),
            'password' => $this->string()->null(),
            'observations' => $this->text(),
            'created_at' => $this->dateTime()->defaultValue('now'),
            'updated_at' => $this->dateTime()->defaultValue('now'),
            'deleted_at' => $this->dateTime()->defaultValue(null),
            'deleted' => $this->boolean()->defaultValue(false),
        ]);


    }

    public function safeDown(): void
    {
        $this->dropTable('{{%user}}');
    }
}
