<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\TrendingNewsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="trending-news-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'headline_text') ?>

    <?= $form->field($model, 'image_url') ?>

    <?= $form->field($model, 'news_info') ?>

    <?= $form->field($model, 'news_url') ?>

    <?php // echo $form->field($model, 'author') ?>

    <?php // echo $form->field($model, 'published') ?>

    <?php // echo $form->field($model, 'date_added') ?>

    <?php // echo $form->field($model, 'date_modified') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
