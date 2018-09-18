<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\UserRequestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User Requests';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-request-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create User Request', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user_ip:ntext',
            'user_agent:ntext',
            'user_remote_ip:ntext',
            'user.username',
            'phone_id:ntext',
            'local_ip:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
