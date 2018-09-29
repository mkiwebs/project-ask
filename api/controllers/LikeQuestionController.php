<?php

namespace api\controllers;
use yii\data\ActiveDataProvider;
// use common\models\LikeQuestion;

class LikeQuestionController extends \yii\rest\ActiveController
{
	public $modelClass = 'common\models\LikeQuestion';
	public $serializer = [
	'class' => 'yii\rest\Serializer',
	//'class' => 'api\components\ApiSerializer',
	'collectionEnvelope' => 'like_question',
	];
}
