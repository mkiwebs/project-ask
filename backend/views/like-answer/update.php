<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\LikeAnswer */

$this->title = 'Update Like Answer: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Like Answers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="like-answer-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
