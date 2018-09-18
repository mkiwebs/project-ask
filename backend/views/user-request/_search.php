<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\UserRequestSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-request-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'user_ip') ?>

    <?= $form->field($model, 'user_agent') ?>

    <?= $form->field($model, 'user_remote_ip') ?>

    <?= $form->field($model, 'user_id') ?>

    <?php // echo $form->field($model, 'phone_id') ?>

    <?php // echo $form->field($model, 'local_ip') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
