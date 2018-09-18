<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\AppEventSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="app-event-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'event_date') ?>

    <?= $form->field($model, 'event_venue') ?>

    <?= $form->field($model, 'event_address') ?>

    <?= $form->field($model, 'event_phone') ?>

    <?= $form->field($model, 'event_image') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'related_category') ?>

    <?php // echo $form->field($model, 'event_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
