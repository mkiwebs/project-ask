<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\MemeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Memes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <?= Html::encode($this->title) ?>
         <?= Html::a('Create Meme', ['create'], ['class' => 'btn btn-success pull-right' ]) ?>
      </div>
      <div class="card-body">

        <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user.username',
            'addtime',
            'meme_url:url',
            [
               'attribute' => 'Likes',
                'value' => function($model) {
                   return $model-> countLikes($model->id);
                }
            ],
            'shares',
            [
               'attribute' =>'Comments',
                'value' => function($model) {
                   return $model-> countComments($model->id);
                }
            ],
            'status',
            'text_content:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
</div>
</div></div>

