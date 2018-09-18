<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\BlogArticleSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="blog-article-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'article_title') ?>

    <?= $form->field($model, 'article_content') ?>

    <?= $form->field($model, 'created_at') ?>

    <?= $form->field($model, 'draft') ?>

    <?php // echo $form->field($model, 'category') ?>

    <?php // echo $form->field($model, 'keywords') ?>

    <?php // echo $form->field($model, 'article_views') ?>

    <?php // echo $form->field($model, 'author') ?>

    <?php // echo $form->field($model, 'date_modified') ?>

    <?php // echo $form->field($model, 'images_url') ?>

    <?php // echo $form->field($model, 'related_articles') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
