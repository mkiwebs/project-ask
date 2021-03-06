<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\MemeCommentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Meme Comments';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .meme-comment-index{
        background-color: white;
        margin: 30px;
    }
</style>
<div class="text-center" style="background-color: green; color: white;">
    <h1><?= Html::encode($this->title) ?></h1>
</div>
<div class="meme-comment-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],

            'id',
            'content:ntext',
            'addtime',
            'uid',
            'dataid',
            'status',
            'recomid',
            'pid',
            'has_sub',
            'likes',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
