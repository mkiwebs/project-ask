<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\QuestionCategory */

$this->title = 'Create Question Category';
$this->params['breadcrumbs'][] = ['label' => 'Question Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="question-category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
