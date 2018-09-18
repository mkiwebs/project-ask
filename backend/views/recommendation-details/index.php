<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\RecommendationDetailsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Recommendation Details';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="recommendation-details-index">

    <h4><?= Html::encode($this->title) ?></h4>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Recommendation Details', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'recommendation_code',
            'recommendor.username',
            'recommended.username',
            'awarded_points',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
