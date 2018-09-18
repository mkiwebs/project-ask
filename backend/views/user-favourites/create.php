<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\UserFavourites */

$this->title = 'Create User Favourites';
$this->params['breadcrumbs'][] = ['label' => 'User Favourites', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-favourites-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
