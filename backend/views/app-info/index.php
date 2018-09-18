<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\AppInfoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'App Infos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="app-info-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create App Info', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'content:ntext',
            'date_added',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
