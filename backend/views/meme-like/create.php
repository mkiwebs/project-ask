<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\MemeLike */

$this->title = 'Create Meme Like';
$this->params['breadcrumbs'][] = ['label' => 'Meme Likes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="meme-like-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
