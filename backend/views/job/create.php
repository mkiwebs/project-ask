<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\JobListing */

$this->title = 'Add New Job';
$this->params['breadcrumbs'][] = ['label' => 'Job Listings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="job-listing-create">

    <h4><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
