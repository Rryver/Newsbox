<?php

namespace app\modules\posts\models;

use Yii;

/**
 * This is the model class for table "posts_post".
 *
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string|null $desctiption
 * @property string|null $content
 * @property int|null $image_preview_id
 * @property int|null $category_id
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'posts_post';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'title'], 'required'],
            [['user_id', 'image_preview_id', 'category_id'], 'integer'],
            [['desctiption', 'content'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['title'], 'string', 'max' => 255],
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
            'title' => 'Title',
            'desctiption' => 'Desctiption',
            'content' => 'Content',
            'image_preview_id' => 'Image Preview ID',
            'category_id' => 'Category ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }


    public function setUserId($userId) {
        $this->user_id = $userId;
    }
}
