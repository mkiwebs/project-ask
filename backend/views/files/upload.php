<?php
/* @var $this yii\web\View */

//upload multiple files
?>
<div hidden class="dropzone">
  
</div>
<?= \app\components\DropZone::widget(
  [
       'options' => [
           'maxFilesize' => '2',
           'paramName'=>'img',
       ],
       'clientEvents' => [
           'complete' => "function(file){console.log(file)}",
           'removedfile' => "function(file){alert(file.name + ' is removed')}"
       ],
   ]

);

?>
