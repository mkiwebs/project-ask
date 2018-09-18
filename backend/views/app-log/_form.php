<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\AppLog */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="app-log-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'log_time')->textInput() ?>

    <?= $form->field($model, 'log_activity')->textInput() ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'device')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
