<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\JobListingSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="job-listing-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'job_title') ?>

    <?= $form->field($model, 'description') ?>

    <?= $form->field($model, 'date_added') ?>

    <?= $form->field($model, 'category') ?>

    <?php // echo $form->field($model, 'company_name') ?>

    <?php // echo $form->field($model, 'location') ?>

    <?php // echo $form->field($model, 'published') ?>

    <?php // echo $form->field($model, 'job_type') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
