<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\FollowQuestionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Question Followers Table';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="follow-question-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
<!-- 
    <p>
        <?= Html::a('Create Follow Question', ['create'], ['class' => 'btn btn-success']) ?>
    </p> -->

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user.username',
            'quiz_id',
            'addtime:date',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
