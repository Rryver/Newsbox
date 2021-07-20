<?php

use common\models\User;
use yii\db\Migration;

/**
 * Class m210720_132549_add_new_user
 */
class m210720_132549_add_new_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $user = new User();
        $user->generateAuthKey();
        $user->setPassword('admin');
        $user->generatePasswordResetToken();
        $user->generateEmailVerificationToken();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210720_132549_add_new_user cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210720_132549_add_new_user cannot be reverted.\n";

        return false;
    }
    */
}
