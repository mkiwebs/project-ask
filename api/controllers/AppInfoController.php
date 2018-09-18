<?php

namespace api\controllers;
use Yii;
use common\models\AppInfo;
use common\models\BlogArticle;
use common\models\UserFeedback;
use yii\data\ActiveDataProvider;
use common\models\AppRelease;
class AppInfoController extends \yii\rest\ActiveController
{
	public $modelClass = 'common\models\AppInfo';
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
	     $app_info = new ActiveDataProvider([
	         'query' => AppInfo::find(),
	         'pagination' => [
	             'defaultPageSize' => 6,
	         ],
	     ]);

	     return $app_info;
	 }

	 public function actionAbout()
	 {
	 	$aboutApp = "Hello this people here is our app,do you like";
	 	$version = "1.0.0";
	 	$contacts = "12345678900";

	 	return array(
	 		'about'     => $aboutApp,
	 		'version'   => $version,
	 		'contacts'  => $contacts
	 	);
	 }

	 public function actionFeedback()
	 {
	 	\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
	 	$attributes = Yii::$app->request->post();
    	$userId = $attributes['id'];
    	$email  = $attributes['email'];
    	$message = $attributes['message'];
    	$model = new UserFeedback();
    	if (isset($userId) && isset($email) && isset($message)) {
    		$model->user_id   = $userId;
    		$model->email     = $email;
    		$model->message   = $message;
    		$model->save();
    		return array(
    					'code' 		=> 201,
    					'message'	=> "Thanks for contacting us,we will take action then get back to you!"
    				);
    	} else {
    		return array(
    					'code' 		=> 401,
    					'message'	=> "An error occured,kindly check your message or try again later!"
    				);
    	}
    	
	 }

	 public function actionAddstory()
	 {
	 	//category id = 23
	 	$how_to_share = BlogArticle::findOne([
	                 'category' => 5,
	               ]);
	 	return array(
	 			'title'   => $how_to_share->article_title,
	 			'content' => $how_to_share->article_content
	 		);
	 }

	 public function actionPartner()
	 {
	 	//category id = 25
	 	$how_to_partner = BlogArticle::findOne([
	                 		'category' => 2,
	               		]);
	 	return array(
	 				'title'  => $how_to_partner->article_title,
	 				'content'=> $how_to_partner->article_content
	 			);
	 }

	 public function actionAsk()
	 {
	 	//category id = 24
	 	$how_to_ask = BlogArticle::findOne([
	                 		'category' => 4,
	               		]);
	 	return  array(
	 				'title' =>$how_to_ask->article_title , 
	 				'content' =>$how_to_ask->article_content
	 			);  
	 }

	 public function actionAddevent()
	 {
	 	//category id = 22 
	 	$add_event = BlogArticle::findOne([
	                 		'category' => 3,
	               		]);
	 	return array(
	 				'title'  => $add_event->article_title,
	 				'content'=> $add_event->article_content
	 			); 
	 }

	 public function actionFeatures()
	 {
	 	//category id = 22 
	 	$add_event = BlogArticle::findOne([
	                 		'id' => 14,
	               		]);
	 	return array(
	 				'title'  => $add_event->article_title,
	 				'content'=> $add_event->article_content
	 			); 
	 }

	 public function actionAppterms()
	 {
	 	//category id = 22 
	 	$add_event = BlogArticle::findOne([
	                 		'id' => 17,
	               		]);
	 	return array(
	 				'title'  => $add_event->article_title,
	 				'content'=> $add_event->article_content
	 			); 
	 }

	 public function actionTest()
	 {
	 	$pathhh = \Yii::getAlias('@backend') . '/web/uploads/user_profile';
	 	return array('path' => $pathhh );
	 }

	 public function actionUpdateapp()
	 {
	 	\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
	 	$params = Yii::$app->request->post();
    	$currentVersionCode = $params['currentVersionCode'];
    	$model  = AppRelease::find()->orderBy(['id' => SORT_DESC])->one();
    	$latestVersionCode  = $model->version_code;
    	$appDownloadLink    = $model->file_link;
    	$latestFeatures     = $model->release_features;
    	//if ($latestVersionCode > $currentVersionCode) {
    	if ($model->app_version > $currentVersionCode) {
    		//download app
    		//'message' => $latestFeatures ,
    		return array(
    			'message' => "New Lyfey App is being downloaded,uninstall the current version to install the new one",
    			'link'    => $appDownloadLink,
    			'release_name'  => $model->release_name,
    			'code'    => "201"
    			);
    	} else {
    		return array(
    			'message' => "You have the latest version of Lyfey App",
    			'code'    => "202",
    			'test'=>$model
    			);
    	}
    	
	 }
}
