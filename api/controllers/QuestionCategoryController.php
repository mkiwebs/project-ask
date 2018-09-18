<?php

namespace api\controllers;

class QuestionCategoryController extends \yii\rest\ActiveController
{   
	public $modelClass = 'common\models\QuestionCategory';
	public $serializer = [
	'class' => 'yii\rest\Serializer',
	//'class' => 'api\components\ApiSerializer',
	'collectionEnvelope' => 'question_category',
	];
}
