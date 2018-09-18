<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\BusinessCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Business Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="business-category-index">

    <h4><?= Html::encode($this->title) ?></h4>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Add Business Category', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'category_name',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
