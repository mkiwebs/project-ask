<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Question */

$this->title = 'Update Question';
$this->params['breadcrumbs'][] = ['label' => 'Questions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->username, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="question-update">

    <h3><?= Html::encode( $model->content ) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
        'questionCategoryList' =>$questionCategoryList,
    ]) ?>

</div>
