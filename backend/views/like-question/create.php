<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\LikeQuestion */

$this->title = 'Create Like Question';
$this->params['breadcrumbs'][] = ['label' => 'Like Questions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="like-question-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
