<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Question */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="question-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'date_added')->textInput() ?>

    <?= $form->field($model, 'date_updated')->textInput() ?>

    <?= $form->field($model, 'answered')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'answered_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'question_answer')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'answer_date')->textInput() ?>

    <?= $form->field($model, 'question_status')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
