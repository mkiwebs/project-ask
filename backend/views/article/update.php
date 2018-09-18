<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\BlogArticle */

$this->title = substr($model->article_title, 0, 50);
$this->params['breadcrumbs'][] = ['label' => 'Blog Articles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="blog-article-update">

    <h4><?= Html::encode($model->article_title) ?></h4>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
