<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%additional_tenant}}`.
 */
class m211226_113244_create_additional_tenant_table extends Migration
{
    public function safeUp(): void
    {
        $this->createTable(
            '{{%additional_tenant}}',
            [
                'id' => $this->primaryKey(),
                'tenant_id' => $this->bigInteger()->unsigned()->notNull(),
                'additional_id' => $this->bigInteger()->unsigned()->notNull(),
                'created_at' => $this->dateTime()->defaultValue('now'),
                'updated_at' => $this->dateTime()->defaultValue('now'),
                'deleted_at' => $this->dateTime()->defaultValue(null),
                'deleted' => $this->boolean()->defaultValue(false),
            ]
        );

        $this->addForeignKey(
            'fk-additional_tenant-tenant_id',
            'additional_tenant',
            'tenant_id',
            'tenant_room',
            'id'
        );

        $this->addForeignKey(
            'fk-additional_tenant-additional_id',
            'additional_tenant',
            'additional_id',
            'additional',
            'id'
        );
    }

    public function safeDown(): void
    {
        $this->dropForeignKey('fk-additional_tenant-tenant_id', 'additional_tenant');
        $this->dropForeignKey('fk-additional_tenant-additional_id', 'additional_tenant');
        $this->dropTable('{{%additional_tenant}}');
    }
}
