<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\QuestionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="question-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'username') ?>

    <?= $form->field($model, 'content') ?>

    <?= $form->field($model, 'date_added') ?>

    <?= $form->field($model, 'date_updated') ?>

    <?php // echo $form->field($model, 'answered') ?>

    <?php // echo $form->field($model, 'answered_by') ?>

    <?php // echo $form->field($model, 'question_answer') ?>

    <?php // echo $form->field($model, 'answer_date') ?>

    <?php // echo $form->field($model, 'question_status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
