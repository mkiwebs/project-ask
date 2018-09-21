<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\MemeCommentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Meme Comments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="meme-comment-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Add New Comment', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

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
