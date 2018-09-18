<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\BusinessCategory */

$this->title = 'Add Business Category';
$this->params['breadcrumbs'][] = ['label' => 'Business Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="business-category-create">

    <h4><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
