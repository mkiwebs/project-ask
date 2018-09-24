<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\components\TinyMce;
use backend\assets\SummernoteAsset;
use yii\helpers\Url;
SummernoteAsset::register($this);
/* @var $this yii\web\View <?= $form->field($model, 'question_answer')->textarea(['rows' => 6]) ?>*/
/* @var $model common\models\Question */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="question-form">
    <h4> <?= $question->content ?> </h4> 
    <?php $form = ActiveForm::begin(); ?>

	<?= $form->field($model, 'answer_content')->textarea(['rows' => 6]);?>

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
