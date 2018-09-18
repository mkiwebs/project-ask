<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\AppLikes */

$this->title = 'Create App Likes';
$this->params['breadcrumbs'][] = ['label' => 'App Likes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="app-likes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
