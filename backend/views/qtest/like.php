<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Question */

$this->title = 'Like Quiz';
$this->params['breadcrumbs'][] = ['label' => 'Qtest', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="question-answer">
    <?= $this->render('_form_like', [
        'model' => $model,
        'question' => $question,
    ]) ?>
</div>
