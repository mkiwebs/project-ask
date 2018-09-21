<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Meme */

$this->title = 'Update Meme: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Memes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="meme-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
