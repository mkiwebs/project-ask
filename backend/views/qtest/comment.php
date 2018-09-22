<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Question */

$this->title = 'Add Comment';
$this->params['breadcrumbs'][] = ['label' => 'IQ Questions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="question-answer">
    <?= $this->render('_form_answer', [
        'model' => $model,
        'question' => $question,
    ]) ?>
</div>
