<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\AppLogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'App Logs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="app-log-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create App Log', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'log_time',
            'log_activity',
            'user.username',
            'device',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
