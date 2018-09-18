<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\AppLikes */

$this->title = 'Update App Likes: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'App Likes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="app-likes-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
