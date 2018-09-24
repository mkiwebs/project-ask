<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\MemeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Memes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="meme-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Meme', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user.username',
            'addtime',
            'meme_url:url',
            'likes',
            'shares',
            'comments',
            'status',
            'text_content:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
