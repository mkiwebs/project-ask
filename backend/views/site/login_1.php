<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<style type="text/css">
  .error-summary {
    display: block !important;
  }
</style>
<div class="site-login">
    <div class="login-box">
      <div class="login-logo">
        <b>Project</b>Ask
      </div>
        <!-- /.login-logo -->
              <div class="login-box-body">
                <p class="login-box-msg">Sign in to start your session</p>
                   <?php $form = ActiveForm::begin([
                    'id'                     => 'login-form',
                    'enableAjaxValidation'   => true,
                    'enableClientValidation' => false,
                    'validateOnBlur'         => false,
                    'validateOnType'         => false,
                    'validateOnChange'       => false,
                ]) ?>
                <?= $form->errorSummary($model); ?> 

                <?= $form->field($model, 'username',['options'=>[
                  'tag'=>'div',
                  'class'=>'form-group field-loginform-username has-feedback'
                ],
                 'template'=>'{input}<span class="glyphicon glyphicon-user form-control-feedback"></span> {error}{hint}'
                ])->textInput(['autofocus' => true,'placeholder'=>'Enter username']) ?>


                <?= $form->field($model, 'password',['options'=>[
                  'tag'=>'div',
                  'class'=>'form-group field-loginform-password has-feedback required'
                ],
                 'template'=>'{input}<span class="glyphicon glyphicon-lock form-control-feedback"></span> {error}{hint}'
                ])->passwordInput(['placeholder'=>'Enter password']) ?>

                <?= $form->field($model, 'rememberMe')->checkbox() ?>

                <div class="form-group">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
