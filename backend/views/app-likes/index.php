<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\AppLikesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'App Likes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="app-likes-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create App Likes', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user_id',
            'item_id',
            'item_type',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
