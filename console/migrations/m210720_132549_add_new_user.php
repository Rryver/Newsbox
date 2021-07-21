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

        $this->insert('{{%user}}', [
            'username' => 'admin',
            'auth_key' => $user->auth_key,
            'password_hash' => $user->password_hash,
            'password_reset_token' => $user->password_reset_token,
            'email' => 'admin@admin.com',
            'created_at' => '0000-00-00 00:00:00',
            'updated_at' => '0000-00-00 00:00:00',
            'verification_token' => $user->verification_token,
            'status' => User::STATUS_ACTIVE,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('{{%user}}', ['username' => 'admin']);

        return false;
    }
}
