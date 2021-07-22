<?php

/**
 * @var $this \yii\web\View
 * @var $post Post
 */

use app\modules\posts\assets\PostsAssets;
use app\modules\posts\models\Post;
use yii\helpers\Html;
use yii\helpers\Url;

PostsAssets::register($this);

$isPostInFavourite = false;
$btnAddToFavourite = $isPostInFavourite ? 'Remove from favourite' : 'Add to favourite';
?>

<div class="posts__post">
  <section class="post">
    <div class="container">
      <div class="post__header">
        <h2 class="post__title font-heading-2"><?= $post->title ?>></h2>
        <div class="post__info">
          <span class="post__date font-label">
            <span class="post__small-caption">Created: <?= empty($post->updated_at) ? 'd-m-y' : $post->created_at ?></span>
            <span class="post__small-caption">Updated: <?= empty($post->updated_at) ? 'd-m-y' : $post->updated_at ?></span>
          </span>
            <?php if (!Yii::$app->user->isGuest) { ?>
              <button class="post__btn-add-favourite"><?= $btnAddToFavourite ?></button>
            <?php } ?>
        </div>

        <img class="post__image" src="<?= $post->getPathToImage() ?>" alt="post-image">
      </div>
      <div class="post__description"><?= $post->description ?></div>

      <div class="post__content">
          <?= $post->content ?>
      </div>


      <a class="post__btn-back btn-common" href="<?= Url::to(Yii::$app->request->referrer) ?>">
        <span class="post__icon-arrow-left glyphicon glyphicon-arrow-left"></span> Back to Posts
      </a>
    </div>
  </section>
</div>
