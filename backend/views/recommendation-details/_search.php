<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\RecommendationDetailsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="recommendation-details-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'recommendation_code') ?>

    <?= $form->field($model, 'recommedor_name') ?>

    <?= $form->field($model, 'recommendation_person') ?>

    <?= $form->field($model, 'awarded_points') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
