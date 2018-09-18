<?php

namespace api\controllers;

use Yii;
use common\models\TrendingNews;
use yii\rest\ActiveController;
use yii\data\ActiveDataProvider;
class TrendingNewsController extends ActiveController
{
	public $modelClass = 'common\models\TrendingNews';
	public $serializer = [
	'class' => 'yii\rest\Serializer',
	       //'class' => 'api\components\ApiSerializer',
	'collectionEnvelope' => 'trendingNews',
	];

	public function actions()
	{
		$actions = parent::actions();
		//unset($actions['index']);
		return $actions;
	}

		protected function verbs()
	{
	    return [
	        'index' => ['GET', 'POST'],
	        //'view' => ['GET', 'HEAD'],
	        //'create' => ['POST'],
	        'update' => ['POST', 'PATCH', 'PUT']
	        //'delete' => ['DELETE'],
	    ];
	}

	public function actionIndex(){
		\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		$trendingNews = new ActiveDataProvider([
			//'query' => \common\models\TrendingNews::find()->select(['headline_text','date_added']),
			'query' => \common\models\TrendingNews::find(),
			'pagination' => [
			'defaultPageSize' => 50,
			],
			'sort'=>[
			'defaultOrder'=>[
			'id'=>SORT_DESC,
			]
			]
			]);
		return $trendingNews;
	}
}
