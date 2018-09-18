<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\UserRequest */

$this->title = 'Create User Request';
$this->params['breadcrumbs'][] = ['label' => 'User Requests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-request-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
