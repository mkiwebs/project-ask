<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\QtestLike */

$this->title = ' Like Quiz';
$this->params['breadcrumbs'][] = ['label' => 'Qtest Likes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="qtest-like-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
