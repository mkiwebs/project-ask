<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\PasswordResetRequestForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Request password reset';
$this->params['breadcrumbs'][] = $this->title;
?>
<style type="text/css">
    .btn-lg,.control-label {
        font-size: 30px;
    }
</style>
<div class="site-request-password-reset">
    <h3><?= Html::encode($this->title) ?></h3>

    <h4>Please fill out your email. A link to reset password will be sent there.</h4>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>

                <?= $form->field($model, 'email')->textInput(['autofocus' => true,'style'=>'height:50px']) ?>

                <div class="form-group">
                    <?= Html::submitButton('Send', ['class' => 'btn btn-lg btn-primary']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
