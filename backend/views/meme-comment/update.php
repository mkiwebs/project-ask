<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\MemeComment */

$this->title = 'Update Meme Comment: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Meme Comments', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="meme-comment-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
