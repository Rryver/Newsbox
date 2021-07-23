<?php

/**
 * @var $this \yii\web\View
 * @var $post \app\modules\posts\models\Post
 * @var $image \app\modules\posts\models\Image
 */

use app\modules\posts\assets\PostsAssets;
use app\modules\posts\models\Category;
use app\modules\posts\models\City;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

PostsAssets::register($this);


$isEditMode = isset($post->id) ? true : false;
$this->title = $isEditMode ? 'Edit post' : 'New post';
?>

<div class="posts__post-edit post-edit">
  <div class="container">
    <h3 class="post-edit__title font-heading-1"><?= $this->title ?></h3>
    <h3 class="post-edit__title font-heading-2"><?= $post->title ?></h3>

      <?php $form = ActiveForm::begin([
          'options' => ['class' => 'post-editor__form-post form-post'],
      ]); ?>

    <div class="form-post__inputs-container">
        <?= $form->field($post, 'title')
            ->textInput(['class' => 'form-post__input', 'placeholder' => 'Post title'])
            ->label($post->attributeLabels()['title'], ['class' => 'form-post__label']) ?>

      <div class="form-post__text-area">
          <?= $form->field($post, 'description')
              ->textarea(['class' => 'form-post__input form-post__input', 'rows' => 5]) ?>
      </div>

      <div class="form-post__text-area">
          <?= $form->field($post, 'content')
              ->textarea(['class' => 'form-post__input form-post__input_textarea', 'rows' => 20]) ?>
      </div>

        <?= $form->field($post, 'category_id')->dropDownList(Category::getAllAsMap()) ?>
        <?= $form->field($post, 'city_id')->dropDownList(City::getAllAsMap()) ?>


        <?php
        if ($isEditMode) {
            echo Html::img($post->getPathToImage(), [
                'alt' => 'post-image',
                'style' => 'max-width: 300px; height: auto',
            ]);
            echo $form->field($image, 'imageFile')->fileInput()->label('Select new file to change post image');
        } else {
            echo $form->field($image, 'imageFile')->fileInput();
        }
        ?>
    </div>


      <?= Html::submitButton('Save', ['class' => 'btn-common form-post__btn']) ?>
      <?php ActiveForm::end(); ?>

  </div>
</div>
