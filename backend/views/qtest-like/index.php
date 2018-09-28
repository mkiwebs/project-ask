<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\QtestLikeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'IQ Questions Likes';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .qtest-like-index{
        background-color: rgb(250,250,250);
        margin: 20px;
    }
</style>
<div class="text-center" style="background-color: green; color: white;">
    <h1><?= Html::encode($this->title) ?></h1>
</div>

<div class="qtest-like-index">

    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],

            'id',
            ['attribute'=>'user.username',
            'label'=>'Username',
          ],
            'addtime:date',
             [
            'label'=>'Date',
            'attribute'=>'addtime',
            'format'=>'date',
            ],
            'qid',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>


