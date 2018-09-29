<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\AppEvent */

$this->title = $model->event_id;
$this->params['breadcrumbs'][] = ['label' => 'App Events', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="app-event-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->event_id], ['class' => 'btn btn-primary']) ?>
    <?= Html::a('Answer', ['follow-event/create', 'id' => $model->event_id,'event'=> strtolower( str_replace(' ', '-', trim( $model->description )) ) ], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->event_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'event_date',
            'event_venue',
            'event_address:ntext',
            'event_phone',
            'event_image',
            'description:html',
            'related_category',
            'event_id',
        ],
    ]) ?>

</div>
