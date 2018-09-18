<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\UserFavourites */

$this->title = $model->fav_id;
$this->params['breadcrumbs'][] = ['label' => 'User Favourites', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-favourites-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->fav_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->fav_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'fav_id',
            'fav_type',
            'user_id',
            'item_id',
            'date_added',
        ],
    ]) ?>

</div>
