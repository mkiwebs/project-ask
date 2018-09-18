<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\QuestionAnswer */

$this->title = Html::encode( Yii::$app->request->get( 'question' ) );
$this->params['breadcrumbs'][] = ['label' => 'Questions', 'url' => ['question/index']];
$this->params['breadcrumbs'][] = ['label' => 'Answers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Html::encode( Yii::$app->request->get( 'question' ) ), 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="question-answer-update">

    <h4><?= Html::encode( Yii::$app->request->get( 'question' ) );    ?></h4>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
