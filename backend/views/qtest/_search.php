<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\QtestSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="qtest-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'uid') ?>

    <?= $form->field($model, 'addtime') ?>

    <?= $form->field($model, 'image') ?>

    <?= $form->field($model, 'comments') ?>

    <?php // echo $form->field($model, 'shares') ?>

    <?php // echo $form->field($model, 'likes') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'content') ?>

    <?php // echo $form->field($model, 'dataid') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
