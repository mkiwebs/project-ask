<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\components\TinyMce;
use yii\helpers\Url;
/* @var $this yii\web\View <?= $form->field($model, 'question_answer')->textarea(['rows' => 6]) ?>*/
/* @var $model common\models\Question */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="question-form">
    <h4> <?= $model->content ?> </h4> 
    <?php $form = ActiveForm::begin(); ?>

	<?= $form->field($model, 'question_answer')->widget(TinyMce::className(), [
	    'options' => ['rows' => 6],
	    'language' => 'en',
	    'clientOptions' => [
	        'plugins' => [
	            "advlist autolink lists link charmap print preview anchor",
	            "searchreplace visualblocks code fullscreen",
	            "preview",

	            "insertdatetime media table contextmenu paste",
	            "imageuploader"
	        ],
	        // 'file_browser_callback'=> new yii\web\JsExpression("function(field_name, url, type, win) {
         //        if(type=='image') {
         //                $('#upload_image input[type=\"file\"]').click();
         //        }
         //    }"),
	        'images_upload_url'=>'postAcceptor.php',
	                // here we add custom filepicker only to Image dialog
	                'file_picker_types'=>'image',
	                // and here's our custom image picker
	                'file_picker_callback'=> new yii\web\JsExpression("function(callback, value, meta) {
	                    var input = document.createElement('input');
	                    input.setAttribute('type', 'file');
	                    input.setAttribute('accept', 'image/*');

	                    //If this is not included, the onchange function will not
	                    //be called the first time a file is chosen 
	                    //(at least in Chrome 58)
	                    var foo = document.getElementById('cms-page_content_ifr');
	                    foo.appendChild(input);

	                    input.onchange = function() {
	                        //alert('File Input Changed');
	                        //console.log( this.files[0] );

	                        var file = this.files[0];

	                        var reader = new FileReader();
	                        reader.readAsDataURL(file);
	                        reader.onload = function () {
	                            // Note: Now we need to register the blob in TinyMCEs image blob
	                            // registry. In the next release this part hopefully won't be
	                            // necessary, as we are looking to handle it internally.

	                            //Remove the first period and any thing after it 
	                            var rm_ext_regex = /(\.[^.]+)+/;
	                            var fname = file.name;
	                            fname = fname.replace( rm_ext_regex, '');

	                            //Make sure filename is benign
	                            var fname_regex = /^([A-Za-z0-9])+([-_])*([A-Za-z0-9-_]*)$/;
	                            if( fname_regex.test( fname ) ) {
	                                var id = fname + '-' + (new Date()).getTime(); //'blobid' + (new Date()).getTime();
	                                var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
	                                var blobInfo = blobCache.create(id, file, reader.result);
	                                blobCache.add(blobInfo);

	                                // call the callback and populate the Title field with the file name
	                                callback(blobInfo.blobUri(), { title: file.name });
	                            }
	                            else {
	                                alert( 'Invalid file name' );
	                            }
	                        };
	                        //To get get rid of file picker input
	                        this.parentNode.removeChild(this);
	                    };

	                    input.click();
	                }"),
	        'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
	    ]
	]);?>

    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
   <form id="upload_image" enctype="multipart/form-data" action="<?=Url::to('/files/summernote')?>" target="test-text_ifr" method="post" enctype="multipart/form-data" style="width:0px;height:0;overflow:hidden">
        <input name="image" type="file" onchange="$('#upload_image').submit();this.value='';">
        <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
    </form>
</div>
