<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\assets\SummernoteAsset;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\Meme */
/* @var $form yii\widgets\ActiveForm */
SummernoteAsset::register($this);
$crfVal = Yii::$app->request->getCsrfToken();
$script = <<< JS
$(document).ready(function() {
    $('#meme-text_content').summernote({  
            height: "500px", 
            minHeight: null,             // set minimum height of editor
            maxHeight: null,             // set maximum height of editor
            focus: true,                // set focus to editable area after initializing summernote
            dialogsInBody: true,
            callbacks: {  
                onImageUpload: function(files) { //the onImageUpload API  
                  $('#modal-image').remove();
                    img = answerFile(files[0]);  
                }
            },
            fontSize: ['8', '9', '10', '11', '12', '14', '16', '18', '20', '24', '30', '36', '48' , '64']  
        });

         function answerFile(file) {  
            data = new FormData();  
            data.append("file", file); 
            data.append("_csrf",'<?php echo $crfVal; ?>') ;
            $.ajax({  
                data: data,  
                type: "POST",  
                //url: "http://localhost/projects/summernote_upload.php" ,  
                //url: "http://localhost/projects/advanced/backend/web/files/summernote", 
                url: 'http://lyfey.ovicko.com/files/summernote',
                cache: false,  
                contentType: false,  
                processData: false, 
                success: function(response) {  
                      console.log(response);
                      $("#questionanswer-answer_content").summernote('insertImage', response, 'image name'); // the insertImage API  
                }  ,
                error: function( data ){
                	console.log(data);
                }
            });  
        }
  })
JS;
$this->registerJs($script);
?>

<div class="meme-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'uid')->textInput() ?>

    <?= $form->field($model, 'memeImage')->fileInput() ?>

    <?= $form->field($model, 'text_content')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>


<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
</div>
