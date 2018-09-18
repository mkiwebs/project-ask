<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\BusinessListing */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Business Listings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="business-listing-view">

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
            //'id',
            'name',
            'address',
            'phone',
            'website',
            'established_year',
            'vat',
            'emp_range',
            'description:ntext',
            'schedule:ntext',
            'products:ntext',
            [
              'attribute'=> 'category',
              'value' => $model->businessCategory->category_name
            ],
            'logo',
        ],
    ]) ?>

</div>
