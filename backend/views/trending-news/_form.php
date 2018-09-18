<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\TrendingNews */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="trending-news-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
    <?= $form->errorSummary($model);?>
    <?= $form->field($model, 'headline_text')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'featuredFile')->fileInput() ?>
    <?= $form->field($model, 'published')->radioList(['1' => 'Yes', '0' => 'No'])?>
    <?= $form->field($model, 'news_info')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'news_url')->textInput(['maxlength' => true]) ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Save' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
