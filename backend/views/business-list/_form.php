<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\BusinessListing;
$business_categories = BusinessListing::categoryDropdown();
use backend\assets\SummernoteAsset;
SummernoteAsset::register($this);
$crfVal = Yii::$app->request->getCsrfToken();
/* @var $this yii\web\View */
/* @var $model common\models\BusinessListing */
/* @var $form yii\widgets\ActiveForm */
$script = <<< JS
$(document).ready(function() {
    $('#businesslisting-description').summernote({  
            height: "300px", 
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

<div class="business-listing-form">

    <?php $form = ActiveForm::begin();  ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'website')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'established_year')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'vat')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'emp_range')->dropDownList([
                                            '1 - 5'   => '1 - 5',
                                            '6 - 10'  => '6 - 10',
                                            '11 - 20' => '11 -20',
                                            '21 - 30' => '21 - 30',
                                            '31 - 40' => '31 - 40',
                                            '41 - 50' => '41 - 50',
                                            '51 - 100' => '51 - 100',
                                            'Over 100' => 'Over 100'],
                                            ['prompt'=>'Select Employee range']); ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'schedule')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'products')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'category')->dropDownList($business_categories,
                                            ['prompt'=>'Select']); ?>

    <?= $form->field($model, 'featuredFile')->fileInput() ?>
    
    <?= $form->field($model, 'published')->radioList(['1' => 'Yes', '0' => 'No']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
