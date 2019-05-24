<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%products}}`.
 */
class m190523_094812_create_products_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%products}}', [
            'id' => $this->primaryKey(),
            'product_name' => $this->string()->notNull(),
            'description' => $this->string()->notNull(),
            'image' => $this->string()->notNull(),
            'price' => $this->float()->notNull(),
            'category_id' => $this->integer()->notNull(),
        ]);
        $this->createIndex('category_id_idx', '{{%products}}', 'category_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%products}}');
    }
}
