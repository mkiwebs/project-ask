<?php 
namespace api\controllers;

use Yii;
use yii\rest\ActiveController;
use common\models\RecommendationDetails;
use common\models\User;
class RecommendationController extends ActiveController
{
    public $modelClass = 'common\models\RecommendationDetails';
    public $serializer = [
		'class' => 'yii\rest\Serializer',
		'collectionEnvelope' => 'recommend'
	];

	public function actions()
	  {
	      $actions = parent::actions();
	      unset($actions['create']);
	      unset($actions['index']);
	      return $actions;
	  } 

	public function actionCreate()
    {
	    $model = new RecommendationDetails();
	    $params = Yii::$app->request->post();
	    $model->recommendation_code = $params['recommendation_code'];
	    //$model->recommedor_name = $params['recommedor_name'];
	    $test = User::checkRecommendCode($params['recommendation_code']);
	   // $recommender = User::findOne($model->recommedor_name);
	    $recommender = User::checkRecommendCode($params['recommendation_code']);
	    $model->recommendation_person = $params['recommended_person'];
	    //if code not empty get the user who has the code
	    if (isset($model->recommendation_code) && $recommender != null ) {
		    	if (isset($model->recommendation_person)) {
		    		$current_points = $recommender->user_points;
		    	    $user_points = 5;
		    		$model->awarded_points = (int)$user_points;
		    		$recommendedUser = User::findOne($model->recommendation_person);
		    		if (($model->recommendation_person != $recommender->id)) {
		    			$recommendedUser->user_points = $recommendedUser->user_points + 5;
		    			$model->recommedor_name = "$recommender->id";
		    			
		    		} else {
		    			$recommendedUser->user_points = $recommendedUser->user_points;
		    			$recommender->user_points = $recommender->user_points;
		    			return array(
					      	'code' => 401,
					        'message' => 'You have to send the code to others first!'
					       );
		    		}
		    		
		    		if ($model->save()) {
		    			$recommendedUser->save();
		    			$recommender->user_points = $recommender->user_points + 5;
		    			$recommender->save();
		    			return array(
					      	'code' => 201,
					      	'user_points' => $recommendedUser->user_points,
					        'message' => 'You have been awarded 5 points'
					       );
		    		} else {
						return array(
	    					'code' 		=> 401,
	    					'message'	=> "Error occurred,try again! ".$recommender->id
	    				);
					}   
			    } else {
			    	return array(
	    					'code' 		=> 401,
	    					'message'	=> "Error occurred,your code does not exist!"
	    				);
			    }
	    	} else {
	    		return array(
    					'code' 		=> 401,
    					'message'	=> "You code does not exist!"
    				);
	    	}
	}
}

?>