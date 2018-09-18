<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\JobCategory */

$this->title = 'Add Job Category';
$this->params['breadcrumbs'][] = ['label' => 'Job Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="job-category-create">

    <h4><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
