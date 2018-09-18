<?php


use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\BlogCategory;
use yii\helpers\ArrayHelper;
use backend\assets\SummernoteAsset;
use yii\helpers\Url;
SummernoteAsset::register($this);
$blogCategories = BlogCategory::find()->all();
$blogCategoryList = ArrayHelper::map($blogCategories,'category_id','category_name');

/* @var $this yii\web\View */
/* @var $model common\models\BlogArticle */
/* @var $form yii\widgets\ActiveForm */
$crfVal = Yii::$app->request->getCsrfToken();
?>
<style type="text/css">
  .modal-backdrop, .modal-backdrop.in{
  display: none;
}
</style>
<div class="blog-article-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'article_title')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'featuredFile')->fileInput() ?>

    <?= $form->field($model, 'article_content')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'draft')->radioList(['1' => 'Yes', '0' => 'No'])?>

    <?= $form->field($model, 'category')->dropDownList(
                                  $blogCategoryList, 
                                ['prompt'=>'Select Category']); ?>

    <?= $form->field($model, 'keywords')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script type="text/javascript">

</script>