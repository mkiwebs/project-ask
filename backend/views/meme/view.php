<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Meme */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Memes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="meme-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p><?= Html::a('Comment', ['comment', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Like', ['like', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
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
            'meme_url:url',
            'likes',
            'shares',
            'comments',
            'status',
            'text_content:ntext',
            'dataid',
        ],
    ]) ?>

</div>
