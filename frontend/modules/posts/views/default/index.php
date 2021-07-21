<?php

use yii\helpers\Url;

?>
<div class="posts-default-index">
    <h1><?= $this->context->action->uniqueId ?></h1>
    <p>
        This is the view content for action "<?= $this->context->action->id ?>".
        The action belongs to the controller "<?= get_class($this->context) ?>"
        in the "<?= $this->context->module->id ?>" module.
    </p>
    <p>
        You may customize this page by editing the following file:<br>
        <code><?= __FILE__ ?></code>
    </p>

    <a class="btn btn-default" href="<?= Url::to(['/posts/default/post']) ?>">Go to post page</a>
    <a class="btn btn-default" href="<?= Url::to(!empty(Yii::$app->request->referrer) ? Yii::$app->request->referrer : Url::to(['/site/index'])) ?>">Go on previous page</a>
</div>
