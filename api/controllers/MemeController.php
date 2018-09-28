<?php

namespace api\controllers;
use Yii;
use yii\data\ActiveDataProvider;
use common\models\Meme;
use common\models\MemeLike;
use yii\helpers\BaseArrayHelper;
class MemeController extends \yii\rest\ActiveController
{
	public $modelClass = 'common\models\Meme';
	public $serializer = [
	'class' => 'yii\rest\Serializer',
	//'class' => 'api\components\ApiSerializer',
	'collectionEnvelope' => 'meme_list',
	];

	public function actions()
	  {
	      $actions = parent::actions();
	      unset($actions['create']);
	      unset($actions['index']);
	      unset($actions['update']);
	      //unset($actions['view']);

	      
	      return $actions;
	  } 

	protected function verbs()
	{
	      return [
	          //'view' => ['POST'],
	          'view' => ['GET', 'POST'],

	      ];
	}


  	 public function actionIndex(){
	 	//'user'=>\Yii::$app->user->identity;
	    \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
	    $memes = new ActiveDataProvider([
	        'query' => \common\models\Meme::find()->select(['id','uid','meme_url','addtime','text_content'])->where(['status' => 0]),
	        'pagination' => [
	            'defaultPageSize' => 50,
	        ],
	        'sort'=>[
                'defaultOrder'=>[

                    'id'=>SORT_DESC,
                    'addtime' => SORT_DESC, 
                ]
            ]
	    ]);

	    return $memes;
	}

	public function actionSinglepost()
	{
		$params = Yii::$app->request->post();
	    $id = $params['id'];
	    $user_id = $params['user_id'];
	    unset($params);
	    $response = array();
	    $response = $this->findModel($id);
	    return $response;
	}

	/**
	 * Displays a single AppRelease model.
	 * @param integer $id
	 * @return mixed

	public function actionView()
	{
	    $params = Yii::$app->request->get();
	    $id = $params['id'];
	    return $this->findModel($id);
	}	 
	*/

	/**
	 * Finds the Articles model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return Articles the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id)
	{
	    if ( ( $model = Meme::findOne( $id ) ) !== null ) {
	        return $model;
	    } else {
	        throw new NotFoundHttpException('The requested page does not exist.');
	    }
	}

	public function actionLike()
	{
		$response = array();
		$params = Yii::$app->request->post();
		$uid = $params['uid'];
		$meme_id = $params['meme_id'];
		//$item_type = $params['item_type'];
		$item_type = "article";
		unset($params);
		//$idExists = $this->findModel( $item_id )->id;
		//if($idExists)
		$likeExists = MemeLike::likeExists($uid,$meme_id);

		if ( $likeExists === 0 ) {
			
			$model  = new MemeLike();
			$model->uid = $uid;
			$model->meme_id = $meme_id;

			if ( $model->save() ) {
				$response["code"] = 201;
				$response["message"] = "You have liked this post";
				//$response["params"] = $params;
				unset($model);

			} else {
				$response["code"] = 401;
				$response["message"] = $model->getErrors();
			}
			

		} else {
		   $response["code"] = 401;
		   $response["message"] = "Error occured or you are not authorized";
		}
		
		return $response;

	}


}
