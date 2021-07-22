<?php


use yii\helpers\Url;
use yii\widgets\Menu;


$linkTemplate = '<a class="menu__link" href="{url}">{label}</a>';
?>


<header class="header">
  <div class="header__container">
    <a class="header__logo" href="<?= Url::to(['/']) ?>"><?= Yii::$app->params['app-name'] ?></a>

    <nav class="header__menu menu">
        <?= Menu::widget([
            'options' => [
                'class' => 'menu__list',
            ],
            'itemOptions' => [
                'class' => "menu__item",
            ],
            'linkTemplate' => $linkTemplate,
            'items' => [
                ['label' => 'Favorites', 'url' => ['/posts/post/index']],
                ['label' => 'Posts', 'url' => ['/posts/post/posts']],
                ['label' => 'Signup', 'url' => ['/site/signup'], 'visible' => Yii::$app->user->isGuest],
                Yii::$app->user->isGuest ? (
                ['label' => 'Login', 'url' => ['/site/login']]
                ) : ['label' => 'Logout',
                    'url' => ['/site/logout'],
                    'template' => '<a class="menu__link" href="{url}" data-method="post">{label}</a>']
            ],
            'activeCssClass' => 'menu__item_active',
        ]) ?>
    </nav>
  </div>
</header>
