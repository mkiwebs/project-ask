<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\RecommendationDetails */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="recommendation-details-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'recommendation_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'recommedor_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'recommendation_person')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'awarded_points')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
