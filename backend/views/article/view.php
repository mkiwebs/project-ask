<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\bootstrap\Button;

/* @var $this yii\web\View */
/* @var $model common\models\BlogArticle */

$this->title = substr($model->article_title, 0, 50);
$this->params['breadcrumbs'][] = ['label' => 'Blog Articles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$crfVal = Yii::$app->request->getCsrfToken();
/* @var $this yii\web\View */
/* @var $model common\models\JobListing */
/* @var $form yii\widgets\ActiveForm */
$script = <<< JS
$(document).ready(function() {
    $("#change-date").click(function(e) { 
         console.log($('#this_article_id').val());
        $.ajax({
             url: 'updatetime',
             type: 'post',
             data: {
                       id: $('#this_article_id').val(), 
                       _csrf : yii.getCsrfToken()
                   },
             success: function (data) {
                console.log(data);
             }
        });  
    });
  })
JS;
$this->registerJs($script);

?>
<div class="blog-article-view">

    <p><?= Html::encode($this->title) ?></p>
    <input hidden type="text" id="this_article_id" name="article_id" value="<?= $model->id ?>">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>

        <?= Button::widget([
            'label' => 'Update Date',
            'options' => [
                'class' => 'btn btn-warning',
                'id'    => 'change-date',
                'data' => [
                    'url' => Url::to(['article/updatetime']),
                    'confirm' => 'Are you sure you want to delete this item?',
                ],
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'article_title',
            'article_content:html',
            'created_at',
            'draft',
            'category',
            'keywords',
            'article_views',
            'author',
            'date_modified',
            'images_url:ntext',
            'related_articles',
        ],
    ]) ?>

</div>
