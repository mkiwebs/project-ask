<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\EventCategory;
use yii\helpers\ArrayHelper;
use backend\assets\SummernoteAsset;
use yii\helpers\Url;
SummernoteAsset::register($this);
/* @var $this yii\web\View */
/* @var $model common\models\AppEvent */
/* @var $form yii\widgets\ActiveForm */

$script = <<< JS
$(document).ready(function() {
    //$("#appevent-event_date").datepicker();
    //Date range picker with time picker
    $('#appevent-event_date').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
  })
JS;
$this->registerJs($script);
?>
<div class="app-event-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'event_date')->textInput() ?>

    <?= $form->field($model, 'event_venue')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'event_address')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'event_phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'eventBanner')->fileInput() ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'related_category')
                    ->dropDownList(ArrayHelper::map(EventCategory::find()
                    ->orderBy('id')
                    ->all(),
                    'id','category_name')) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<!-- date-range-picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
<script type="text/javascript">
    // jQuery( function() {
    //   jQuery("#appevent-event_date").datepicker();
    // } );
</script>
