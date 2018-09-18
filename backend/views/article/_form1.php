<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\BlogCategory;
use yii\helpers\ArrayHelper;

$blogCategories = BlogCategory::find()->all();
$blogCategoryList = ArrayHelper::map($blogCategories,'category_id','category_name');

/* @var $this yii\web\View */
/* @var $model common\models\BlogArticle */
/* @var $form yii\widgets\ActiveForm */

$script = <<< JS
  $(document).ready(function() {
  // Override summernotes image manager
  $('#blogarticle-article_content').each(function() {
    var element = this;
    $(element).summernote({
      lang: $(this).attr('data-lang'),
      disableDragAndDrop: true,
      height: 300,
      emptyPara: '',
      codemirror: { // codemirror options
        mode: 'text/html',
        htmlMode: true,
        lineNumbers: true,
        theme: 'monokai'
      },      
      fontsize: ['8', '9', '10', '11', '12', '14', '16', '18', '20', '24', '30', '36', '48' , '64'],
      toolbar: [
        ['style', ['style']],
        ['font', ['bold', 'underline', 'clear']],
        ['fontname', ['fontname']],
        ['fontsize', ['fontsize']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['table', ['table']],
        ['insert', ['link', 'image', 'video']],
        ['view', ['fullscreen', 'codeview', 'help']]
      ],
      popover: {
              image: [
          ['custom', ['imageAttributes']],
          ['imagesize', ['imageSize100', 'imageSize50', 'imageSize25']],
          ['float', ['floatLeft', 'floatRight', 'floatNone']],
          ['remove', ['removeMedia']]
        ],
      },      
      buttons: {
          image: function() {
          var ui = $.summernote.ui;
              
          // create button
          var button = ui.button({
            contents: '<i class="note-icon-picture" />',
            tooltip: $.summernote.lang[$.summernote.options.lang].image.image,
            click: function () {
              $('#modal-image').remove();
              
              $.ajax({
                url: 'http://localhost/projects/advanced/backend/web/files/upload',
                dataType: 'html',
                beforeSend: function() {
                  $('#button-image i').replaceWith('<i class="fa fa-circle-o-notch fa-spin"></i>');
                  $('#button-image').prop('disabled', true);
                },
                complete: function() {
                  $('#button-image i').replaceWith('<i class="fa fa-upload"></i>');
                  $('#button-image').prop('disabled', false);
                },
                success: function(html) {
                  console.log(html);
                  $('body').append('<div id="modal-image" class="modal">' + html + '</div>');
                  
                  $('#modal-image').modal('show');
                  
                  $('#modal-image').delegate('a.thumbnail', 'click', function(e) {
                    e.preventDefault();
                    
                    $(element).summernote('insertImage', $(this).attr('href'));
                                  
                    $('#modal-image').modal('hide');
                  });
                }
              });           
            }
          });
        
          return button.render();
        }
        }
    });
  });
});
JS;
$this->registerJs($script);
?>

<div class="blog-article-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'article_title')->textInput(['maxlength' => true]) ?>

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
