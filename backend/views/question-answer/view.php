<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\QuestionAnswer */

$this->title = Html::encode( $model->question->content );
$this->params['breadcrumbs'][] = ['label' => 'Questions', 'url' => ['question/index']];
$this->params['breadcrumbs'][] = ['label' => 'Question Answers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="question-answer-view">

    <h4><?= Html::encode( $model->question->content ) ?></h4>

    <p>
        <?= Html::a('Like', ['like-answer/create', 'id' => $model->id,'question'=> strtolower( str_replace(' ', '-', trim( $model->answer_content )) ) ], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Update', 
                [
                    'update',
                    'id' => $model->id,
                    'question' => Html::encode( $model->question->content )
                 ],
                [
                    'class' => 'btn btn-primary'
                ]) 
            ?>

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
            // 'id',
            // 'question_id',
            [
              'attribute'=> 'question_id',
              'value' => $model->question->content
            ],

            [
              'attribute'=> 'user_id',
              'value' => $model->user->username
            ],
            'answer_content:ntext',
            'answer_date',
            'date_modified',
            'published',
            'likes',
        ],
    ]) ?>

</div>
