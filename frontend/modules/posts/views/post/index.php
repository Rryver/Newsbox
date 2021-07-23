<?php

/**
 * @var $this \yii\web\View
 * @var $posts Post[]
 * @var $pages \yii\data\Pagination
 */

use app\modules\posts\models\Post;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\widgets\Pjax;

?>



<div class="posts__index">
    <div class="container">
        <h3 class="font-heading-1">Favorites</h3>

      <?php Pjax::begin(); ?>

      <ul class="posts__list">
          <?php if (empty($posts)) { ?>
            <h3 class="posts__not-found font-heading-2">No posts for this request</h3>
          <?php } ?>
          <?php foreach ($posts as $post) { ?>
            <li class="posts__item">
              <div class="posts__card-post card-post">
                <a class="card-post__link" href="<?= Url::to(['/posts/post/post', 'id' => $post->id]) ?>">
                  <h4 class="card-post__title font-heading-2"><?= $post->title ?></h4>
                </a>
                <span class="card-post__date"><?= $post->created_at ?></span>
                <p class="card-post__description"><?= $post->description ?></p>
              </div>
            </li>
          <?php } ?>
      </ul>

      <div class="posts__pagination-widget pagination-widget">
          <?= LinkPager::widget([
              'options' => ['class' => 'pagination-widget__list'],
              'pagination' => $pages,
              'pageCssClass' => 'pagination-widget__item',
              'prevPageCssClass' => 'pagination-widget__item pagination-widget__item_prev',
              'nextPageCssClass' => 'pagination-widget__item pagination-widget__item_nex',
              'activePageCssClass' => 'pagination-widget__item_active',
              'linkOptions' => ['class' => 'pagination-widget__link'],
          ]) ?>
      </div>
      <?php Pjax::end(); ?>
    </div>
</div>
