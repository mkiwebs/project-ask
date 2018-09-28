<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\LikeQuestion */

$this->title = 'Update Like Question: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Like Questions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="like-question-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
