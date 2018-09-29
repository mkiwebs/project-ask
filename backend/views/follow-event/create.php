<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\FollowEvent */

$this->title = 'Create Follow Event';
$this->params['breadcrumbs'][] = ['label' => 'Follow Events', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="follow-event-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
