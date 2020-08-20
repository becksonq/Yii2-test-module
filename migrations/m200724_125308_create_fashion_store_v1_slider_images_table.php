<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%fashion_store_v1_slider_images}}`.
 */
class m200724_125308_create_fashion_store_v1_slider_images_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%fashion_store_v1_slider_images}}', [
            'id'        => $this->primaryKey(),
            'parent_id' => $this->integer()->notNull(),
            'file'      => $this->string()->notNull(),
            'sort'      => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%fashion_store_v1_slider_images}}');
    }
}
