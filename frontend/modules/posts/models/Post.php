<?php

namespace app\modules\posts\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "posts_post".
 *
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string|null $description
 * @property string $content
 * @property int|null $image_preview_id
 * @property int $category_id
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property int city_id
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
            [['user_id', 'title', 'category_id', 'content', 'city_id'], 'required'],
            [['user_id', 'image_preview_id', 'category_id', 'city_id'], 'integer'],
            [['description', 'content'], 'string', 'min' => 5],
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
            'description' => 'Short description',
            'content' => 'Text',
            'image_preview_id' => 'Image Preview ID',
            'category_id' => 'Category ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ]
        ];
    }


    public function setUserId($userId) {
        $this->user_id = $userId;
    }

    public function getPathToImage()
    {
        $image = Image::getOneById($this->image_preview_id);

        if (!isset($image)) {
            return '';
        }

        return  $image->getPathToImage();
    }

}
