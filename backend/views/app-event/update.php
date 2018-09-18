<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\AppEvent */

$this->title = 'Update App Event: ' . $model->event_id;
$this->params['breadcrumbs'][] = ['label' => 'App Events', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->event_id, 'url' => ['view', 'id' => $model->event_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="app-event-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
