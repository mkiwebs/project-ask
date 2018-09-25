<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\LikeAnswerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Like Answers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="like-answer-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Like Answer', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'uid',
            'question_id',
            'addtime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
