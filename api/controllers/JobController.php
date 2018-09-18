<?php

namespace api\controllers;

use yii\data\ActiveDataProvider;
use common\models\JobListing;
class JobController extends \yii\rest\ActiveController
{
	public $modelClass = 'common\models\JobListing';
	public $serializer = [
	'class' => 'yii\rest\Serializer',
	//'class' => 'api\components\ApiSerializer',
	'collectionEnvelope' => 'job_list',
	];

	public function actions()
	  {
	      $actions = parent::actions();
	      //unset($actions['create']);
	      unset($actions['index']);
	      //unset($actions['update']);
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
	 	//'user'=>\Yii::$app->user->identity;
	    \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
	    $jobs = new ActiveDataProvider([
	        'query' => JobListing::find(),
	        'pagination' => [
	            'defaultPageSize' => 20,
	        ],
	        'sort'=>[
                'defaultOrder'=>[
                    'id'=>SORT_DESC,
                ]
            ]
	    ]);
	    return $jobs;
	}

	public function actionTest()
	{
		// $json = array(
		// 	'name' => 'Martin',
		// 	'married' => 'No',
		// 	'age' => '25',
		// 	 );
		$json = array();
		$json['people'] = array();
		$json['people'] = array(
				$json1 = array(
					'name' => 'Martin',
					'married' => 'No',
					'age' => '25',
					 ),
				$json1 = array(
					'name' => 'Martin',
					'married' => 'No',
					'age' => '25',
					 )
			);
		return $json;
	}
}
