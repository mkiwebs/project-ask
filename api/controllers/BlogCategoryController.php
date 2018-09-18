<?php

namespace api\controllers;

class BlogCategoryController extends \yii\rest\ActiveController
{
	public $modelClass = 'common\models\BlogCategory';
	public $serializer = [
	'class' => 'yii\rest\Serializer',
	//'class' => 'api\components\ApiSerializer',
	'collectionEnvelope' => 'blog_category',
	];
}
