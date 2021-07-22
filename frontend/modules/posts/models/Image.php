<?php

namespace app\modules\posts\models;

use Yii;

/**
 * This is the model class for table "posts_image".
 *
 * @property int $id
 * @property string $name
 * @property string $extension
 */
class Image extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'posts_image';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'extension'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['extension'], 'string', 'max' => 10],
            [['name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'extension' => 'Extension',
        ];
    }
}
