<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\UserRequest */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-request-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_ip')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'user_agent')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'user_remote_ip')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
