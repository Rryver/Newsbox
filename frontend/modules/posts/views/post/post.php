<?php

/**
 * @var $this \yii\web\View
 * @var $post Post
 */

use app\modules\posts\assets\PostsAssets;
use app\modules\posts\models\Post;

PostsAssets::register($this);



?>

<div class="posts__post">
  <section class="post">
    <div class="container">
      <button class="post__button btn-common"><span class="glyphicon glyphicon-arrow-left"></span> Back to Posts</button>

      <div class="post__header">
        <h2 class="post__title font-heading-2"><?= $post->title ?>></h2>
        <div class="post__info">
          <span class="post__date font-label">
            <span class="post__small-caption">Updated:</span>
            <?= empty($post->updated_at) ? 'd-m-y' : $post->updated_at ?>
          </span>

          <img class="post__image" src="" alt="post-image">
          <p class="post__desctription"><?= $post->desctiption ?></p>
        </div>

        <div class="post__content">
          <?= $post->content ?>
        </div>

      </div>
    </div>
  </section>
</div>
