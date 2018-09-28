<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\MemeLikeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Meme Likes';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .meme-like-index{
        background-color: rgb(250,250,250);
        margin: 20px;
    }
</style> 
<div class="text-center" style="background-color: green; color: white;">
    <h1><?= Html::encode($this->title) ?></h1>
</div>
<div class="meme-like-index">

   
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],
            'id',
            [
            'label'=>'Date',
            'attribute'=>'user.username',
            'format'=>'text',
            'contentOptions'=>['class'=>'bg-green']
            ],
            'meme_id',
            // 'addtime:date',
                        [
            'label'=>'Date',
            'attribute'=>'addtime',
            'format'=>'date',
            'contentOptions'=>['class'=>'bg-purple']
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
