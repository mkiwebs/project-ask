<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\JobListingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Job Listings';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="job-listing-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Add new Job', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'job_title',
            'date_added',
            [
              'attribute'=> 'category',
              'value' => 'jobCategory.category_name'
            ],
            'company_name',
            'location',
            [
              'attribute'=> 'published',
              'value' => function($data){ //return "Pending";
                              if ($data->published == 1 ) {
                                  return "Yes";
                              } else {
                                  return "No";
                              }
                        }
            ],
            // 'job_type',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
