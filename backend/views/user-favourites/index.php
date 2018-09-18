<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\UserFavouritesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User Favourites';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-favourites-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create User Favourites', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'fav_id',
            'fav_type',
            'user_id',
            'item_id',
            'date_added',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
