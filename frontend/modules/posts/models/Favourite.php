<?php

namespace app\modules\posts\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "posts_favourite".
 *
 * @property int $id
 * @property int $user_id
 * @property int $post_id
 */
class Favourite extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'posts_favourite';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'post_id'], 'required'],
            [['user_id', 'post_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'post_id' => 'Post ID',
        ];
    }

    public static function getUserFavouritePosts()
    {
        return ArrayHelper::map(static::find()->where(['user_id' => Yii::$app->user->id])->all(),'post_id', 'post_id');
    }

    public function removeFromFavourite($postId)
    {
        $favouriteRow = self::find()->where(['post_id' => $postId])->andWhere(['user_id' => Yii::$app->user->id])->one();

        if ($favouriteRow !== null) {
            if ($favouriteRow->delete()){
                return true;
            }
        }

        return false;
    }
}
