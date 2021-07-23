<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%towns}}`.
 */
class m210723_063844_create_city_table extends Migration
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

        $this->createTable('{{%posts_city}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull()->unique(),
        ], $tableOptions);

        $this->addColumn('{{%posts_post}}', 'city_id', $this->integer());

        $this->insert('{{%posts_city}}', [
            'name' => 'Saint-Petersburg',
        ]);
        $this->insert('{{%posts_city}}', [
            'name' => 'Moscow',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%posts_city}}');
        $this->dropColumn('{{%posts_post}}', 'city_id');
    }
}
