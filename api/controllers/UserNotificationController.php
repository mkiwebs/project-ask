<?php

namespace api\controllers;

use common\models\UserNotification;
use yii\data\ActiveDataProvider;
class UserNotificationController extends \yii\rest\ActiveController
{
	public $modelClass = 'common\models\UserNotification';
	public $serializer = [
	'class' => 'yii\rest\Serializer',
	'collectionEnvelope' => 'notifications',
	];

	public function actions()
	{
		$actions = parent::actions();
		unset($actions['create']);
		unset($actions['index']);
		return $actions;
	} 

	public function actionIndex(){
	     \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
	     $notifications = new ActiveDataProvider([
	         'query' => UserNotification::find(),
	         'pagination' => [
	             'defaultPageSize' => 6,
	         ],
	     ]);

	     return $notifications;
	 }


}
