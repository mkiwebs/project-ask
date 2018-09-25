<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\QtestLike */

$this->title = 'Update Qtest Like: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Qtest Likes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="qtest-like-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
