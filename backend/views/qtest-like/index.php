<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\QtestLikeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Qtest Likes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="qtest-like-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Qtest Like', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'uid',
            'addtime',
            'qid',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
