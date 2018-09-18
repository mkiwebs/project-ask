<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\RecommendationDetails */

$this->title = 'Create Recommendation Details';
$this->params['breadcrumbs'][] = ['label' => 'Recommendation Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="recommendation-details-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
