<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Qcomment */

$this->title = 'Create Qcomment';
$this->params['breadcrumbs'][] = ['label' => 'Qcomments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="qcomment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
