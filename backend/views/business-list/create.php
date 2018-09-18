<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\BusinessListing */

$this->title = 'Add New Business Listing';
$this->params['breadcrumbs'][] = ['label' => 'Business Listings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="business-listing-create">

    <h4><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
