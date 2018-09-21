<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Qtest */

$this->title = 'Create Qtest';
$this->params['breadcrumbs'][] = ['label' => 'Qtests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="qtest-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
