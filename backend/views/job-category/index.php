<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\JobCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Job Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="job-category-index">

    <h4><?= Html::encode($this->title) ?></h4>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Add Job Category', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'category_name',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
