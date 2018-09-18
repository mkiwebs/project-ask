<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\AppEvent */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="app-event-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'event_date')->textInput() ?>

    <?= $form->field($model, 'event_venue')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'event_address')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'event_phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'event_image')->textInput() ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'related_category')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'event_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
