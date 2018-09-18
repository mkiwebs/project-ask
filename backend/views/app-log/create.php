<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\AppLog */

$this->title = 'Create App Log';
$this->params['breadcrumbs'][] = ['label' => 'App Logs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="app-log-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
