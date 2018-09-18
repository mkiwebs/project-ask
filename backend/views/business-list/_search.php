<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\BusinessListingSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="business-listing-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'address') ?>

    <?= $form->field($model, 'phone') ?>

    <?= $form->field($model, 'website') ?>

    <?php // echo $form->field($model, 'established_year') ?>

    <?php // echo $form->field($model, 'vat') ?>

    <?php // echo $form->field($model, 'emp_range') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'schedule') ?>

    <?php // echo $form->field($model, 'products') ?>

    <?php // echo $form->field($model, 'category') ?>

    <?php // echo $form->field($model, 'logo') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
