<?php

namespace api\controllers;
use Yii;
use common\models\Qtest;
use yii\data\ActiveDataProvider;
use yii\web\UploadedFile;
use common\models\UserProfile;
use common\models\User;
use common\models\AppLog;
use common\models\AppModel;
use yii\helpers\Html;
use common\models\QuestionAnswer;

class QtestController extends \yii\rest\ActiveController
{
 public $modelClass = 'common\models\Qtest';
 public $serializer = [
        'class' => 'yii\rest\Serializer',
        //'class' => 'api\components\ApiSerializer',
        'collectionEnvelope' => 'questions',
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
    $questions = new ActiveDataProvider([
        'query' => \common\models\Qtest::find()
        ->andHaving(['<=', 'username', 5]),
        'pagination' => [
            'defaultPageSize' => 1000,
        ],
        'sort'=>[
                'defaultOrder'=>[
                    'id'=>SORT_DESC,
                ]
            ]
    ]);

    return $questions;
	}

     /**
     * Add new question.
     *
     * @return mixed
     */
    public function actionCreate()
    {
	    \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
      $model = new Qtest();
	    $params = Yii::$app->request->post();
	    $model->content  = $params['content'];
	    $model->username = $params['username'];

      if ( isset( $params['category'] ) ) {
        $model->question_category = $params['category'];
      } else {
          $model->question_category = 1;
      }
	    // $model->email=$params['email'];
    
  		if ($model->save()) {
  		      $response['code'] = 201;
  		      $response['message'] = 'Question added!';
            $response['questionId'] = $model->id;
  		      //$response['user'] =\common\models\User::findByUsername($model->username);
  		    return $response;
  		} else {
  		      $model->getErrors();
  		      $response['code'] = 401;
  		     	$response['hasErrors'] = $model->hasErrors();
  		     	$response['errors'] = $model->getErrors();
            $response['message'] = "Encountered an error while handling your request";
  		            //return = $model;
              return $response;

  	   }
	}

  public function actionUpload()
  {

  //$user_profile = 'http://192.168.1.102/projects/advanced/backend/web/uploads/';
  //production
  $user_profile = "http://lyfey.ovicko.com/uploads/";
  //response array
  $response = array();
  $uploadedFile = UploadedFile::getInstanceByName('image');
  $ymd = date("Ymd");
   //absolute url to save images

  //\yii\web\UploadedFile::getInstanceByName('image');
  if($params = Yii::$app->request->post()){
    
    //checking the required parameters from the request
    if(isset($_POST['user_id']) and isset($_FILES['image']['name'])){
      //getting name from the request
      $name = $_POST['user_id'];
      
      //getting file info from the request
      $fileinfo = pathinfo($_FILES['image']['name']);
      
      //getting the file extension
      $extension = $fileinfo['extension'];
      $file_name = $fileinfo['filename'].date('YmdHis').rand(10000,99999);

      //file path to upload in the server
      //$file_path = $upload_path . $file_name . '.'. $extension;
      $save_path = \Yii::getAlias('@backend') . '/web/uploads/' . $ymd . '/';
      if (!file_exists($save_path)) {
                      mkdir($save_path, 0777, true);
                  }
      
      //trying to save the file in the directory
      try{
        //saving the file
        $uploadedFile->saveAs($save_path . $file_name. '.' . $extension);
       // move_uploaded_file($_FILES['image']['tmp_name'],$upload_path);
         $userImage = new UserProfile();
         $userImage->user_id = $name;
         $userImage->profile_image = $ymd . '/'. $file_name. '.' . $extension;
         $userImage->save();
         //update user image
          $attributes = Yii::$app->request->post();
          $userId = $attributes['user_id'];
        if (($model = User::findOne($userId)) !== null) {
        //$model->attributes = Yii::$app->request->post();
          if (isset($attributes['user_id'])) {
            $model->user_image = $ymd . '/'. $file_name. '.' . $extension;
            $model->save();
          }
         }

         $response['error'] = false;
         $response['url'] = $user_profile. $ymd . '/'. $file_name. '.' . $extension;
         $response['user_image'] = $ymd . '/'. $file_name. '.' . $extension;
         //$response['params'] = $user_profile. $ymd . '/'. $file_name. '.' . $extension;
        // }
      //if some error occurred
      }catch(Exception $e){
        $response['error']=true;
        $response['message']=$e->getMessage();
      }
      //displaying the response
      return $response;
    } else {
      $response['error']=true;
      $response['message']='Please choose a file';
      return $response;
    }
  }
  }

  public function actionEditorimage()
  {

      //$user_profile = 'http://192.168.1.102/projects/advanced/backend/web/uploads/';
      //production
      $user_profile = "http://lyfey.ovicko.com/uploads/";
      //response array
      $response = array();
      $uploadedFile = UploadedFile::getInstanceByName('image');
      $ymd = date("Ymd");

      if( $params = Yii::$app->request->post() ){     
          //checking the required parameters from the request
          if(isset($_POST['user_id']) and isset($_FILES['image']['name'])){
            //getting name from the request
            $name = $_POST['user_id'];
            
            //getting file info from the request
            $fileinfo = pathinfo($_FILES['image']['name']);
            
            //getting the file extension
            $extension = $fileinfo['extension'];
            $file_name = $fileinfo['filename'].md5(time());

            $save_path = \Yii::getAlias('@backend') . '/web/uploads/' . $ymd . '/';

            if ( !file_exists( $save_path ) ) {

                mkdir($save_path, 0777, true);

            }
            
            //trying to save the file in the directory
            try{
              //saving the file
              $uploadedFile->saveAs($save_path . $file_name. '.' . $extension);

               $response['error'] = false;
               $response['url'] = $user_profile. $ymd . '/'. $file_name. '.' . $extension;
               $response['user_image'] = $ymd . '/'. $file_name. '.' . $extension;

            //if some error occurred
            } catch( Exception $e ) {

              $response['error'] = true;
              $response['message'] = $e->getMessage();

            }

            return $response;

          } else {
            
            $response['error'] = true;
            $response['message'] ='Please choose a file';
            return $response;
          }
      }
  }

  /*

   Receives the answer from the app
  */
  public function actionReceive()
  {
        $response = array();

        if ($params = Yii::$app->request->post()) {
      
          $question_id = (int)$params['question_id'];

          $user_id = (int)$params['user_id'];

          $answer_content = $params['answer_content'];

          $app_signature = $params['app_signature'];

          if ( $app_signature ) {
                    
            $model = new QuestionAnswer();
            $model->question_id   = $question_id;
            $model->answer_content   = $answer_content;
            $model->user_id   = $user_id;

            if ( $model->save() ) {

                $response['message'] = "Answer posted successfully";
                $response['code']    = 201;

            } else {
                $response['message'] = "Encountered an error while handling data,please try again";
                $response['code']    = 401;
            }

          } else {

            $response['message'] = "You are not allowed to submit your answer!";
            $response['code']    = 401;
          }

          return $response;
        }
  }


   public function actionAnswers(){

    $response = array();

    if ($params = Yii::$app->request->post()) {
      
        $question_id = (int)$params['question_id'];
        //$question_id = (int)4;

        $query = \common\models\QuestionAnswer::find()
            ->where(['question_id' => $question_id])
            ->orderBy('id')
            ->all();


        $html_content = AppModel::webViewHeader();     
        $html_content .= '<h3>'.Question::findQuestionById( $question_id ).'</h3>';
        $html_content .= '<p>'.count($query).' Answers</p>';
        
        $html_content .= '<div class="col-md-5ths col-sm-5ths red">
              </div>';

        if ( count( $query ) > 0 ) {
          foreach ($query as $answer) {
            
            if ( $answer->user->username === "admin" ) {
                 $answered_by = "Selina";
            } else {
              $answered_by = $answer->user->username;
            }
            
            $html_content .= AppModel::AnswerHeading(
              array(
                'username' => $answered_by,
                'date'     => date("M d Y", $answer->answer_date),
               )
            );
           
           $html_content .= $answer->answer_content;
           
           $html_content .= "<br><br>";
           $html_content .= '<div class="col-md-5ths col-sm-5ths red">
              </div>';
           $html_content .= "<br>";

          }
        } else {
          $html_content .= "<p>No answer yet<p>";
        }

        $html_content .= AppModel::webViewFooter();
        $javascript = '

        ';
        $response['data'] = $html_content;
        $response['question'] = "Test question";

        $new_app  = \common\models\AppRelease::find()->orderBy(['id' => SORT_DESC])->one();
        $response['app_version']  = $new_app->app_version;

        return $response;
      }
  }

  public function actionSinglefile()
  {
   
    \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    //response array
    $response = array();
    //create date string to be used a year
    $ymd = date("Ymd");
    //get the 'image' being send via api
    //Returns an uploaded file according to the given file input name.
    //The name can be a plain string or a string like an array element (e.g. 'Post[imageFile]', or 'Post[0][imageFile]').

    $uploadedFile = UploadedFile::getInstanceByName('image');
    if ($uploadedFile) {
      //get the uploaded file name
      $filename = $uploadedFile->name;
      //pathinfo() returns more info about the $uploadFile
      $pathinfo = pathinfo($uploadedFile);
      //create a new filename to avoid file collission
      $filename = $pathinfo['filename'].date('YmdHis').rand(10000,99999);
      //get extension
      $extension  = $uploadedFile->getExtension();
      //directory to save the image
      $save_path = \Yii::getAlias('@backend') . '/web/uploads/' . $ymd . '/';
      //check if dir already exists
        if (!file_exists($save_path)) {
          //make dir ,give permissions
            mkdir($save_path, 0777, true);
          }
          //save file
        $uploadedFile->saveAs($save_path . $filename. '.' . $extension);
      return $response = array(
                                'fileinfo' => pathinfo($uploadedFile),
                                'filename' => $filename
                              );
    } else {
      return array(
                    'file' => $uploadedFile->error,
                  );
    }
  
    
  }

  public function actionUser()
  {
    \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    $response = array();
    if ($params = Yii::$app->request->post()) {
      $user_id = $params['user_id'];
      $questions = \common\models\User::findOne($user_id)->question;
      if (count($questions) > 0) {
        return $response = array(
          'code' => 201,
          'questions' => $questions
         );
      } else {
        return $response = array(
        'message' =>"You have not asked a  question",
        'code'    => 202
         );
      }
      
      return count($questions);
    } else {
      return $response = array(
        'message' =>"Error occured",
        'code'    => 401
         );
    }

  }
}
