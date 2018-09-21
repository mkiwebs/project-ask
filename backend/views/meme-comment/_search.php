<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\MemeCommentSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="meme-comment-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'content') ?>

    <?= $form->field($model, 'addtime') ?>

    <?= $form->field($model, 'uid') ?>

    <?= $form->field($model, 'dataid') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'recomid') ?>

    <?php // echo $form->field($model, 'pid') ?>

    <?php // echo $form->field($model, 'has_sub') ?>

    <?php // echo $form->field($model, 'likes') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>