<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\JobListing */

$this->title = $model->job_title;
$this->params['breadcrumbs'][] = ['label' => 'Job Listings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="job-listing-view">

    <h4><?= Html::encode($this->title) ?></h4>

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
            'job_title',
            'description:html',
            'date_added:date',
            [
              'attribute'=> 'category',
              'value' => $model->jobCategory->category_name
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
          
            [
              'attribute'=>   'job_type',
              'value' => $model->jobType
            ],
        ],
    ]) ?>

</div>
