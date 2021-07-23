<?php

/**
 * @var $this yii\web\View
 * @var $posts Post[]
 * @var $pages \yii\data\Pagination
 * @var $postSearch \app\modules\posts\models\PostSearch
 */

use app\modules\posts\assets\PostsAssets;
use app\modules\posts\models\City;
use app\modules\posts\models\Post;
use common\widgets\Alert;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;
use yii\widgets\Pjax;

PostsAssets::register($this);

?>

<div class="posts__posts">
  <div class="container">
      <?= Alert::widget() ?>

      <?php Pjax::begin() ?>

    <div class="posts__header">
      <h1 class="posts__title">Posts</h1>
        <?= Html::beginForm(['/posts/post/posts'], 'post', ['data-pjax' => '', 'class' => 'posts__cities']) ?>

        <?= Html::dropDownList('selectedCity', Yii::$app->session->get('selectedCity', 0), City::getAllAsMap(), ['class' => 'form-edit__input posts__cities-input',]) ?>

        <?= Html::submitButton('Set', ['class' => 'btn-common posts__cities-btn']) ?>
        <?= Html::endForm() ?>
    </div>

      <?= Html::beginForm(
          ['/posts/post/posts'],
          'post',
          ['data-pjax' => '', 'class' => 'posts__search-form search-form ']) ?>

      <?= Html::input(
          'text',
          'postSearch',
          Yii::$app->request->post('postSearch'),
          ['class' => 'search-form__input form-edit__input']) ?>

      <?= Html::submitButton('Search', ['class' => 'search-form__btn btn-common']) ?>
      <?= Html::endForm(); ?>


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

      <?php Pjax::end() ?>

      <?php if (!Yii::$app->user->isGuest) { ?>
        <a class="posts__btn-new-post btn-link btn-common" href="<?= Url::to(['/posts/post/post-create']) ?>">Create
          new
          post</a>
      <?php } ?>
  </div>
</div>
