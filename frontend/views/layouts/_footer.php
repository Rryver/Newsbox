<?php


use yii\helpers\Html; ?>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Html::encode(Yii::$app->params['app-name']) ?> </p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>
