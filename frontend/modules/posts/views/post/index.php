<?php

/**
 * @var $this \yii\web\View
 */

use yii\helpers\Url;

?>



<div class="posts__index">
    <div class="container">
        <h3>Favorites</h3>



        <?php if (!Yii::$app->user->isGuest) { ?>
          <a class="posts__btn-new-post btn-link btn-common" href="<?= Url::to(['/posts/post/post-create']) ?>">Create new post</a>
        <?php } ?>
    </div>
</div>
