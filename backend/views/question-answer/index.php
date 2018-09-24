<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\QuestionAnswerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Question Answers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="question-answer-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Question Answer', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],

            'id',
            'question_id',
            'user.username',
            'answer_content:ntext',
            'answer_date:date',
            // 'date_modified',
            // 'published',
            // 'likes',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
