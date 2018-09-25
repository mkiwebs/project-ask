<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\QtestAnswer */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Qtest Answers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="qtest-answer-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Like', ['answer-like/create', 'id' => $model->id,'question'=> strtolower( str_replace(' ', '-', trim( $model->content )) ) ], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
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
            'id',
            'uid',
            'qid',
            'content',
            'addtime:datetime',
            'likes',
            'date_updated',
            'status',
        ],
    ]) ?>

</div>
