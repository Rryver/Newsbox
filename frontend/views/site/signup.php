<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Signup';
?>
<div class="site-signup">.
  <div class="container">
    <h1 class="font-heading-1"><?= Html::encode($this->title) ?></h1>

    <p style="margin-top: 40px;">Please fill out the following fields to signup:</p>

      <?php $form = ActiveForm::begin([
          'id' => 'form-signup',
          'options' => ['class' => 'form-edit form-edit_mt'],
      ]); ?>

      <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'class' => 'form-edit__input']) ?>

      <?= $form->field($model, 'email')->textInput(['class' => 'form-edit__input']) ?>

      <?= $form->field($model, 'password')->passwordInput(['class' => 'form-edit__input']) ?>

    <div class="form-group">
        <?= Html::submitButton('Signup', ['class' => 'btn-common', 'name' => 'signup-button']) ?>
    </div>

      <?php ActiveForm::end(); ?>
  </div>
</div>
