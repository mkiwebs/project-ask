<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\AuthAssignment */

$this->title = 'Assign user role';
$this->params['breadcrumbs'][] = ['label' => 'Auth Assignments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-assignment-create">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
        'auth_items' => $auth_items,
        'users' => $users,
    ]) ?>

</div>
