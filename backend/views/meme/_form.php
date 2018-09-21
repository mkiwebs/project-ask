<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\assets\SummernoteAsset;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Meme */
/* @var $form yii\widgets\ActiveForm */
SummernoteAsset::register($this);
?>

<div class="meme-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'uid')->textInput() ?>

    <?= $form->field($model, 'memeImage')->fileInput() ?>

    <?= $form->field($model, 'text_content')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
