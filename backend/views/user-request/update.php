<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\UserRequest */

$this->title = 'Update User Request: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'User Requests', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-request-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
