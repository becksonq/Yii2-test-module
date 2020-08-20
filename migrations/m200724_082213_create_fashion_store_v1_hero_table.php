<?php

use console\migrations\Migration;

/**
 * Handles the creation of table `{{%fashion_store_v1_hero}}`.
 */
class m200724_082213_create_fashion_store_v1_hero_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%fashion_store_v1_hero}}', [
            'id'           => $this->primaryKey(),
            'hero_name'    => $this->string()->notNull(),
            'description'  => $this->text(),
            'slider_items' => $this->text()->notNull(),
            'status'       => $this->integer()->notNull()->defaultValue(0),
            'created_at'   => $this->integer()->unsigned()->notNull(),
            'updated_at'   => $this->integer()->unsigned()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%fashion_store_v1_hero}}');
    }
}
