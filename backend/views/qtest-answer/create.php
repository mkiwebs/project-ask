<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\QtestAnswer */

$this->title = 'Create Qtest Answer';
$this->params['breadcrumbs'][] = ['label' => 'Qtest Answers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="qtest-answer-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
