<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\UserRequest */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'User Requests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-request-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
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
            'id',
            'user_ip:ntext',
            'user_agent:ntext',
            'user_remote_ip:ntext',
            'user_id',
            'phone_id:ntext',
            'local_ip:ntext',
        ],
    ]) ?>

</div>
