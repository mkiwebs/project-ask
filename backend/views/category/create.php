<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\BlogCategory */

$this->title = 'Create Blog Category';
$this->params['breadcrumbs'][] = ['label' => 'Blog Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blog-category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
