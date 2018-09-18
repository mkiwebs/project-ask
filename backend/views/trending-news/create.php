<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\TrendingNews */

$this->title = 'Add Trending News';
$this->params['breadcrumbs'][] = ['label' => 'Trending News', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="trending-news-create">

    <h4><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
