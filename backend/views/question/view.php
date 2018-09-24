<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model common\models\Question */

$this->title = substr($model->content, 0, 50);
$this->params['breadcrumbs'][] = ['label' => 'Questions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="question-view">

    <p><?= Html::encode($this->title) ?></p>
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Answer', ['question-answer/create', 'id' => $model->id,'question'=> strtolower( str_replace(' ', '-', trim( $model->content )) ) ], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Follow', ['follow-question/create', 'id' => $model->id,'question'=> strtolower( str_replace(' ', '-', trim( $model->content )) ) ], ['class' => 'btn btn-primary']) ?>
        <!-- <?= Html::a('Answer', ['answer', 'id' => $model->id], ['class' => 'btn btn-primary']) ?> -->
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'user.username',
            'content:ntext',
            'date_added:date',
            'date_updated:date',

            [
              'attribute'=> 'question_category',
              'value' => $model->category->category_name
            ],
            
            [
            'attribute' =>'answered',
            'value' => function($data){
                            //return "Pending";
                            if ($data->answered == 0 ) {
                                return "Not yet";
                            } else {
                                return "Answered";
                            }
                            
                        }
            ],
            'answeredby.username',
            'question_answer:html',
            'answer_date:date',
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
        ],
    ]) ?>

</div>
