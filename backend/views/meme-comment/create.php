<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\MemeComment */

$this->title = 'Add Comment';
$this->params['breadcrumbs'][] = ['label' => 'Meme Comments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="meme-comment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
