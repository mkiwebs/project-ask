<?php


use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Arrayhelper;
use common\models\BlogArticle;
/* @var $this yii\web\View <?= Yii::$app->request->getBaseUrl(); ?><br>
    <?= Yii::$app->request->getServerName(); ?>*/
/* @var $searchModel common\models\BlogArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Blog Articles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blog-article-index">

    <h4><?= Html::encode($this->title) ?></h4>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
    
        <?= Html::a('Add Blog Article', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'article_title',
            'created_at:date',
            //'draft',
            [
            'attribute' =>'draft',
            'value' => function($data){ //return "Pending";
                            if ($data->draft == 0 ) {
                                return "Published";
                            } else {
                                return "Draft";
                            }
                          }
            ],
            [
             'attribute' =>'category',
             'value'  => 'blogCategory.category_name',
             'filter' => $categoryDropdown
             //'filter' => BlogArticle::dropDown('BlogArticle','category_id','category_id','category_name')
             //Arrayhelper::map(BlogCategory::find()->orderBy('category_id')->asArray()->all(),'category_id','category_name');
            ],
            // 'keywords',
            // 'article_views',

            //'' => 'Category ID',
            //'category_name' => 'Category Name',
            'user.username',
            // 'date_modified',
            // 'images_url:ntext',
            // 'related_articles',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
