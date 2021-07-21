<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m210721_135213_create_main_tables
 */
class m210721_135213_create_main_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=MariaDB';
        }

        $this->createTable('post', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'title' => $this->string(255)->notNull(),
            'desctiption' => $this->text(),
            'content' => $this->text(),
            'image_preview_id' => $this->integer(),
            'created_at' => Schema::TYPE_DATETIME,
            'updated_at' => Schema::TYPE_DATETIME,
        ]);



        $this->createTable('category', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique(),
        ]);

        $this->createTable('postCategory', [
            'id' => $this->primaryKey(),
            'post_id' => $this->integer()->notNull(),
            'category_id' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey(
            'fk_category-id_post',
            'postCategory',
            'post_id',
            'post',
            'id'
            );

        $this->addForeignKey(
            'fk_category-id_category',
            'postCategory',
            'category_id',
            'category',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('post');
        $this->dropTable('category');
        $this->dropTable('postCategory');

        return false;
    }
}
