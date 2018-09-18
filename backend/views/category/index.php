<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\BlogCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Blog Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blog-category-index">

    <h4><?= Html::encode($this->title) ?></h4>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Add Blog Category', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'category_id',
            'category_name',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
