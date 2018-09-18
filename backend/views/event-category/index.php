<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\EventCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Event Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-category-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Event Category', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'category_name',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
