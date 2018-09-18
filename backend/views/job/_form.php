<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\assets\SummernoteAsset;
use yii\helpers\Url;
use common\models\JobListing;
SummernoteAsset::register($this);
$crfVal = Yii::$app->request->getCsrfToken();
$job_categories = JobListing::categoryDropdown();
/* @var $this yii\web\View */
/* @var $model common\models\JobListing */
/* @var $form yii\widgets\ActiveForm */
$script = <<< JS
$(document).ready(function() {
    $('#joblisting-description').summernote({  
            height: "500px", 
            minHeight: null,             // set minimum height of editor
            maxHeight: null,             // set maximum height of editor
            focus: true,                // set focus to editable area after initializing summernote
            dialogsInBody: true,
            fontSize: ['8', '9', '10', '11', '12', '14', '16', '18', '20', '24', '30', '36', '48' , '64']  
        });
  })
JS;
$this->registerJs($script);
?>
<script type="text/javascript">

</script>
<div class="job-listing-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'job_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'category')->dropDownList(
                                  $job_categories, 
                                ['prompt'=>'Select Category']) ?>

    <?= $form->field($model, 'company_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'location')->textInput(['maxlength' => true]) ?>

     <?= $form->field($model, 'job_type')->dropDownList([
                                            '1' => 'Internship',
                                            '2' => 'Part time',
                                            '3' => 'Full time'],
                                            ['prompt'=>'Select']); ?>

    <?= $form->field($model, 'published')->radioList(['1' => 'Yes', '0' => 'No']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
