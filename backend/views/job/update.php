<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\JobListing */

$this->title = substr($model->job_title, 0, 50);

$this->params['breadcrumbs'][] = ['label' => 'Job Listings', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="job-listing-update">

    <h4><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
