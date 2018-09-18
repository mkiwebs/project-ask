<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\AuthItemChild */

$this->title = 'Add User permission'; //Add Auth Item Child
$this->params['breadcrumbs'][] = ['label' => 'Add User permission', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-item-child-create">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
        'auth_items' => $auth_items,
    ]) ?>

</div>
