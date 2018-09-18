<?php

use yii\helpers\Html;
use common\models\JobListing;

/* @var $this yii\web\View */
/* @var $model common\models\BlogArticle */
$job_categories = JobListing::categoryDropdown();
$this->title = 'Create Blog Article';
$this->params['breadcrumbs'][] = ['label' => 'Blog Articles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blog-article-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'job_categories' => $job_categories
    ]) ?>

</div>
