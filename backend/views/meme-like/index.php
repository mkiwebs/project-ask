<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\MemeLikeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Meme Likes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="meme-like-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Meme Like', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user.username',
            'meme_id',
            'addtime:date',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
