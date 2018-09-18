<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\BusinessListingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Business Listings';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="business-listing-index">

    <h4><?= Html::encode($this->title) ?></h4>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Add Business Listing', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'name',
            'address',
            'phone',
            'website',
            // 'established_year',
            // 'vat',
            'emp_range',
            // 'description:ntext',
            // 'schedule:ntext',
            // 'products:ntext',
            [
              'attribute'=> 'category',
              'value' => 'businessCategory.category_name'
            ],
            // 'logo',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
