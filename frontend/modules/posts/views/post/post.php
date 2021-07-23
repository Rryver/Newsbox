<?php

/**
 * @var $this \yii\web\View
 * @var $post Post
 * @var $isPostInFavourite bool
 * @var $param Favourite
 */

use app\modules\posts\assets\PostsAssets;
use app\modules\posts\models\Favourite;
use app\modules\posts\models\Post;
use yii\helpers\Html;
use yii\helpers\Url;

PostsAssets::register($this);


$btnFavourite = $isPostInFavourite ? 'Remove from favourite' : 'Add to favourite';
?>


<div class="posts__post">
  <section class="post">
    <div class="container">
      <div class="post__header">
        <h2 class="post__title font-heading-2"><?= $post->title ?></h2>
        <div class="post__info">
          <span class="post__date font-label">
            <span class="post__small-caption">Created: <?= empty($post->updated_at) ? 'd-m-y' : $post->created_at ?></span>
          </span>
            <?php if (!Yii::$app->user->isGuest) { ?>
              <a class="post__btn-add-favourite"
                 href="<?= Url::to(['/posts/post/favourite', 'postId' => $post->id, 'isPostInFavourite' => (int)$isPostInFavourite]) ?>"><?= $btnFavourite ?></a>
            <?php } ?>
        </div>

        <img class="post__image" src="<?= $post->getPathToImage() ?>" alt="post-image">
      </div>
      <div class="post__description"><?= $post->description ?></div>

      <div class="post__content">
          <?= $post->content ?>
      </div>


      <div class="post__btns">
        <a class="post__btn btn-common" href="<?= Url::to(['/posts/post/posts']) ?>">
          <span class="post__icon-arrow-left glyphicon glyphicon-arrow-left"></span> Back to Posts
        </a>
        <a class="post__btn btn-common" href="<?= Url::to(['/posts/post/posts-similar', 'categoryId' => $post->category_id]) ?>">Similar
          posts</a>
      </div>
    </div>
  </section>
</div>
