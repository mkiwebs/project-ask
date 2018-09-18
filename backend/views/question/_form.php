<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\assets\SummernoteAsset;
/* @var $this yii\web\View */
/* @var $model common\models\Question */
/* @var $form yii\widgets\ActiveForm */
SummernoteAsset::register($this);
?>

<div class="question-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->errorSummary($model) ?>
    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'question_category')->dropDownList(
                                  $questionCategoryList, 
                                ['prompt'=>'Select Category']); ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
