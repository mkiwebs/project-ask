<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\AppEventSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'App Events';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="app-event-index">

    <h4><?= Html::encode($this->title) ?></h4>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create App Event', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'event_date',
            'event_venue',
            'event_address:ntext',
            'event_phone',
            'event_image',
            // 'description:ntext',
            // 'related_category',
            // 'event_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
