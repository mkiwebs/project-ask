<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\AppInfo */

$this->title = 'Create App Info';
$this->params['breadcrumbs'][] = ['label' => 'App Infos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="app-info-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
