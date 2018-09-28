<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\QuestionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Questions';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .question-index{
        background-color: rgb(250,250,250);
        margin: 20px;
    }
</style> 
<div class=" ">
    <p>
    <?= Html::a('Add Question', ['create'], ['class' => 'btn btn-success ']) ?>
    </p>
</div>
<div class="question-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'showHeader' => true,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'user.username',
            [
            'attribute' => 'content',
             "format" => "html",
                         //'contentOptions' => ['style' => 'width:10px;']
            'contentOptions' => ['style' => ['max-width' => '300px', 'height' => '100px']]
                         //'contentOptions' => ['class' => 'text-wrap']
            ],
            
            'date_added:date',
            [
               'attribute' =>'Answers',
                'value' => function($model) {
                   return $model-> countAnswers($model->id);
                }
            ],
            //'date_updated',
            // 'answered',
            [
               'attribute' =>'Follows',
                'value' => function($model) {
                   return $model-> countFollowers($model->id);
                }
            ],
            'answeredby.username',
            //'question_answer:ntext',
            'answer_date:date',
            'likes',
            [
            'attribute' =>'question_status',
            'value' => function($data){
                            //return "Pending";
                            if ($data->question_status == 10 ) {
                                return "Pending";
                            } else {
                                return "Pending1";
                            }
                            
                        }
            ],
            
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
