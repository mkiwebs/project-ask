<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Question */

$this->title = 'Answer Question';
$this->params['breadcrumbs'][] = ['label' => 'Questions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="question-answer">
    <?= $this->render('_form_follow', [
        'model' => $model,
        'question' => $question,
    ]) ?>
</div>
