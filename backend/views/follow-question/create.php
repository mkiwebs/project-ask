<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\FollowQuestion */

$this->title = 'Create Follow Question';
$this->params['breadcrumbs'][] = ['label' => 'Follow Questions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="follow-question-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
