<?php

namespace api\controllers;
use Yii;
use yii\data\ActiveDataProvider;
use common\models\BlogArticle;
use common\models\AppLikes;
use yii\helpers\BaseArrayHelper;
class ArticleController extends \yii\rest\ActiveController
{
	public $modelClass = 'common\models\BlogArticle';
	public $serializer = [
	'class' => 'yii\rest\Serializer',
	//'class' => 'api\components\ApiSerializer',
	'collectionEnvelope' => 'blog_article',
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
	    $articles = new ActiveDataProvider([
	        'query' => \common\models\BlogArticle::find()->select(['id','article_title','images_url','created_at'])->where(['draft' => 0]),
	        'pagination' => [
	            'defaultPageSize' => 50,
	        ],
	        'sort'=>[
                'defaultOrder'=>[

                    'id'=>SORT_DESC,
                    'created_at' => SORT_DESC, 
                ]
            ]
	    ]);

	    return $articles;
	}

	public function actionSinglepost()
	{
		$params = Yii::$app->request->post();
	    $id = $params['article_id'];
	    $user_id = $params['user_id'];
	    unset($params);
	    $response = array();
	    $response = $this->findModel($id);
	    //$response['user'] = $user;
	    $likeExists = AppLikes::likeExists($user_id,$id);

	    if ( $likeExists === 0 ) {
	    	//$response['liked'] = false;
	    	$response->liked = "0";
	    } else {
	    	//$response['liked'] = true;
	    	$response->liked = "1";
	    }
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
	    if ( ( $model = BlogArticle::findOne( $id ) ) !== null ) {
	        return $model;
	    } else {
	        throw new NotFoundHttpException('The requested page does not exist.');
	    }
	}
    
	public function actionCategory(){
	 	
	 	$params = Yii::$app->request->post();

	    $categoryId = $params['categoryId'];

	    \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

	    $articles = new ActiveDataProvider([
	        'query' => BlogArticle::find()
	        						->select([
	        							'id',
	        							'article_title',
	        							'images_url',
	        							'created_at'
	        						])
	        						->where([
	        							'draft' => 0,
	        							'category'=> $categoryId
	        						]),
	        'pagination' => [
	            'defaultPageSize' => 100,
	        ],
	        'sort'=>[
                'defaultOrder'=>[
                    'id' => SORT_DESC,
                    'created_at' => SORT_DESC,
                ]
            ]
	    ]);

	    return $articles;
	}

	public function actionLike()
	{
		$response = array();
		$params = Yii::$app->request->post();
		$user_id = $params['user_id'];
		$item_id = $params['item_id'];
		//$item_type = $params['item_type'];
		$item_type = "article";
		unset($params);
		//$idExists = $this->findModel( $item_id )->id;
		//if($idExists)
		$likeExists = AppLikes::likeExists($user_id,$item_id);

		if ( $likeExists === 0 ) {
			
			$model  = new AppLikes();
			$model->user_id = $user_id;
			$model->item_id = $item_id;
			$model->item_type = $item_type;

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
