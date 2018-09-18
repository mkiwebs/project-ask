<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\AppRelease */

$this->title = 'Update App Release: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'App Releases', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="app-release-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
