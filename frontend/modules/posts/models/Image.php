<?php

namespace app\modules\posts\models;

use Yii;
use yii\web\UploadedFile;

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
     * @var UploadedFile
     */
    public $imageFile;

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
            [['imageFile'], 'file', 'extensions' => 'png, jpg'],
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

    public function getUploadDirectory()
    {
        return '../../upload/images/';
    }

    public function save($runValidation = true, $attributeNames = null)
    {
        if (!isset($this->imageFile))
        {
            return false;
        }

        $this->name = $this->imageFile->baseName . '_id=' . time();
        $this->extension = $this->imageFile->extension;
        if ($this->upload()) {
            if (parent::save(true, ['id', 'name', 'extension'])) {
                return true;
            }
        }

        return false;
    }

    public function upload()
    {
        if ($this->validate()) {
            $this->imageFile->saveAs($this->getUploadDirectory() . $this->name . '.' . $this->extension);
            return true;
        } else {
            return false;
        }
    }

    public function deleteImageById($id)
    {
        if (self::deleteAll(['id' => $id])) {
            return true;
        }
        return false;
    }

    public static function getOneById($id)
    {
        return static::findOne(['id' => $id]);
    }

    public function getPathToImage()
    {
        return $this->getUploadDirectory() . $this->name . '.' . $this->extension;
    }
}
