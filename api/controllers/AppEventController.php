<?php

namespace api\controllers;

use yii\data\ActiveDataProvider;
use common\models\AppEvent;
class AppEventController extends \yii\rest\ActiveController
{
	public $modelClass = 'common\models\AppEvent';
	public $serializer = [
	'class' => 'yii\rest\Serializer',
	//'class' => 'api\components\ApiSerializer',
	'collectionEnvelope' => 'app_event',
	];

	public function actions()
	  {
	      $actions = parent::actions();
	      //unset($actions['create']);
	      unset($actions['index']);
	      //unset($actions['update']);
	      return $actions;
	  }

	public function actionIndex(){
	 	//'user'=>\Yii::$app->user->identity;
	    \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
	    $events = new ActiveDataProvider([
	        'query' => AppEvent::find(),
	        'pagination' => [
	            'defaultPageSize' => 20,
	        ],
	        'sort'=>[
                'defaultOrder'=>[
                    'event_id'=>SORT_DESC,
                ]
            ]
	    ]);
	    return $events;
	}
}
