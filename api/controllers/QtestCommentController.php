<?php

namespace api\controllers;

use yii\data\ActiveDataProvider;
use common\models\QComment;
class QtestCommentController extends \yii\rest\ActiveController
{
	public $modelClass = 'common\models\QComment';
	public $serializer = [
	'class' => 'yii\rest\Serializer',
	//'class' => 'api\components\ApiSerializer',
	'collectionEnvelope' => 'comment_list',
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
	        'query' => QtestLike::find(),
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

}
