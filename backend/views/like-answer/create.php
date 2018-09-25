<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\LikeAnswer */

$this->title = 'Create Like Answer';
$this->params['breadcrumbs'][] = ['label' => 'Like Answers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="like-answer-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
