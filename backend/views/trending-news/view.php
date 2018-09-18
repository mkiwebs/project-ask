<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\TrendingNews */

$this->title = $model->headline_text;
$this->params['breadcrumbs'][] = ['label' => 'Trending News', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trending-news-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
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
            'id',
            'headline_text:ntext',
            'image_url:ntext',
            'news_info:ntext',
            'news_url:ntext',
            'user.username',
            'publishStatus',
            'dateadded',
            'date_modified',
        ],
    ]) ?>

</div>
