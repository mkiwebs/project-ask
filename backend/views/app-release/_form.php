<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\AppRelease */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="app-release-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'release_name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'release_features')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'file_link')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'app_version')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'version_code')->textInput(['maxlength' => true]) ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Publish' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
