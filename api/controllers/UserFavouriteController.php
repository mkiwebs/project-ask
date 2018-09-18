<?php

namespace api\controllers;

use Yii;
use common\models\UserFavourites;
use yii\data\ActiveDataProvider;
class UserFavouriteController extends \yii\rest\ActiveController
{
	public $modelClass = 'common\models\UserFavourite';
	public $serializer = [
	'class' => 'yii\rest\Serializer',
	//'class' => 'api\components\ApiSerializer',
	'collectionEnvelope' => 'user_favorite',
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
	     $favourites =  UserFavourites::find()->all();
	     //loop through theget the favourites type and item id,
	     // $favourites = new ActiveDataProvider([
	     //     'query' => UserFavourite::find(),
	     //     'pagination' => [
	     //         'defaultPageSize' => 6,
	     //     ],
	     // ]);

	     $favourites_response = array();
	     foreach ($favourites as $favourite) {
	     	$favBody = UserFavourites::favouriteBody($favourite->fav_type,$favourite->item_id);
	     	//$favourites_response['id']   = ;
	     	 $favourites_response[] =  $favBody;
	     	
	     }
	     $response['user_favorite'] = $favourites_response;
	     //get the favourite body,
	     //id,bodytext,item_url
	     return $response;
	 	}
	     /**
	     * Signs user up.
	     *
	     * @return mixed
	     */
	    public function actionCreate()
	    {
	        $model = new UserFavourites();
	        //get the params from the okhttp3.9
	        $params = Yii::$app->request->post();
	        $model->user_id  = $params['user_id'];
	        $model->fav_type = $params['fav_type'];
	        $model->item_id  = $params['item_id'];

			if ($model->save()) {
			   	$response['code']      = 201;
				$response['message']   = 'Added to your favourites!';
				return $response;   
	    	} else {
		            $model->validate();
		            return $model;
		    }
		}
}
