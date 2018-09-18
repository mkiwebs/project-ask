<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\AppRelease */

$this->title = 'Add App Release';
$this->params['breadcrumbs'][] = ['label' => 'App Releases', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="app-release-create">

    <h4><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
