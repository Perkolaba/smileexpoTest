<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%comments}}`.
 */
class m190523_100515_create_reviews_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%reviews}}', [
            'id' => $this->primaryKey(),
            'date' => $this->date()->notNull(),
            'username' => $this->string()->notNull(),
            'user_email' => $this->string()->notNull(),
            'comment_text' => $this->string()->notNull(),
            'product_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull()
        ]);
        $this->createIndex('product_id_idx', '{{%reviews}}', 'product_id');
        $this->addForeignKey(
            'fk-reviews-products',
            '{{%reviews}}',
            'product_id',
            '{{%products}}',
            'id',
            'CASCADE'
        );
        $this->createIndex('user_id_idx', '{{%reviews}}', 'user_id');
        $this->addForeignKey(
            'fk-reviews-users',
            '{{%reviews}}',
            'user_id',
            '{{%users}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%reviews}}');
    }
}
