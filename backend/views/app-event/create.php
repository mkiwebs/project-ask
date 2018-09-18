<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\AppEvent */

$this->title = 'Create App Event';
$this->params['breadcrumbs'][] = ['label' => 'App Events', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="app-event-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
