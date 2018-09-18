<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\UserFavourites */

$this->title = 'Update User Favourites: ' . $model->fav_id;
$this->params['breadcrumbs'][] = ['label' => 'User Favourites', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->fav_id, 'url' => ['view', 'id' => $model->fav_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-favourites-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
