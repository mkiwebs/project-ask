<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Meme */

$this->title = 'Create Meme';
$this->params['breadcrumbs'][] = ['label' => 'Memes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="meme-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
