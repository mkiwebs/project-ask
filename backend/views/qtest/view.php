<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Qtest */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Qtests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="qtest-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Comment', ['comment', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
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
            'addtime',
            'image',
            'comments',
            'shares',
            'likes',
            'status',
            'content:ntext',
            'dataid',
        ],
    ]) ?>

</div>
