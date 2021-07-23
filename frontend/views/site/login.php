<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
?>


<div class="site-login">
  <div class="container">
    <h1 class="site-login__title font-heading-1"><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to login:</p>

      <?php $form = ActiveForm::begin([
          'id' => 'login-form',
          'layout' => 'horizontal',
          'options' => ['class' => 'login-form form-edit'],
          'fieldConfig' => [
              'template' => "{label}\n<div class=\"col-lg-8 col-lg-offset-1\">{input}</div>\n<div class=\"col-lg-offset-2 col-lg-8\">{error}</div>",
              'labelOptions' => ['class' => 'col-lg-1 control-label'],
          ],
      ]); ?>

      <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'class' => 'form-edit__input']) ?>

      <?= $form->field($model, 'password')->passwordInput(['class' => 'form-edit__input']) ?>

      <?= $form->field($model, 'rememberMe')->checkbox([
          'template' => "<div class=\"col-lg-offset-2 col-lg-4\">{input} {label}</div>\n<div class=\"col-lg-offset-2 col-lg-8\">{error}</div>",
      ]) ?>

    <div class="form-group">
      <div class="col-lg-offset-2 col-lg-11">
          <?= Html::submitButton('Login', ['class' => 'btn-common', 'name' => 'login-button']) ?>
      </div>
    </div>

      <?php ActiveForm::end(); ?>

    <div class="col-lg-offset-2" style="color:#999;">
      Вы можете войти <strong>admin/admin</strong>
    </div>
  </div>
</div>
