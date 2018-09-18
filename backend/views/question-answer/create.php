<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\QuestionAnswer */

$this->title = 'Answer question';
$this->params['breadcrumbs'][] = ['label' => 'Questions', 'url' => ['question/index']];
$this->params['breadcrumbs'][] = ['label' => 'Answers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="question-answer-create">

    <h4><?= Html::encode($question) ?></h4>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
