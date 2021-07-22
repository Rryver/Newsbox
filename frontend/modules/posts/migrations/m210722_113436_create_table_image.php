<?php

use yii\db\Migration;

/**
 * Class m210722_113436_create_table_images
 */
class m210722_113436_create_table_image extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%posts_image}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique(),
            'extension' => $this->string(10)->notNull(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%posts_image}}');
    }
}
