<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\TrendingNewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Trending News';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trending-news-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Add Trending News', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'headline_text:ntext',
            //'image_url:ntext',
             'news_info:ntext',
            //'news_url:ntext',
            // 'author',
             'publishStatus',
             'dateadded',
            // 'date_modified',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
