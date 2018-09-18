<?php
/* @var $this yii\web\View */


?>
<script src="../js/dropzone.js"></script>
<h1>files/upload</h1>

<!-- <form method="post" enctype="multipart/form-data" action=".../../upload" class="dropzone">
  <div class="fallback">
    <input name="file" type="file" multiple />
  </div>
</form> -->
<form method="post" id="my-awesome-dropzone" enctype="multipart/form-data" class="dropzone" action=".../../do">
<input name="_csrf-backend" type="hidden" value="<?php echo Yii::$app->request->csrfToken; ?>">
<input name="img[]" type="file" > 
<input name="img[]" type="file" >  
<input name="img[]" type="file" >   
<button type="submit" class="btn btn-primary pull-right">Submit</button>
</form>

<div id="upload-files">
	
</div>

<script type="text/javascript">

</script>
<?= \app\components\DropZone::widget();?>
<?php



	$script = <<< JS
		$(document).ready(function() {
	Dropzone.options.uploadFiles = {
  paramName: "file", // The name that will be used to transfer the file
  maxFilesize: 2, // MB
  dictDefaultMessage  :       "Drop File here or Click to upload Image",
        thumbnailWidth      :       "300",
        thumbnailHeight     :       "300",
  accept: function(file, done) {
    if (file.name == "justinbieber.jpg") {
      done("Naha, you don't.");
    }
    else { done(); }
  }
};
})
JS;
$this->registerJs($script);

?>