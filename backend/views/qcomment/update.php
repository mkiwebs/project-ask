<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Qcomment */

$this->title = 'Update Qcomment: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Qcomments', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="qcomment-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
