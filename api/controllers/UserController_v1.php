<?php
namespace api\controllers;

use Yii;
use yii\rest\ActiveController;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\User;
use frontend\models\SignupForm;
use common\models\LoginForm;
use yii\data\ActiveDataProvider;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\QueryParamAuth;
use yii\helpers\ArrayHelper;
use yii\filters\ContentNegotiator;
use yii\web\Response;
use yii\db\ActiveRecord;
use api\models\PasswordResetRequestForm;
use api\models\ResetPasswordForm;
/**
 * Usercontroller
 */
class UserController extends ActiveController
{

 public $modelClass = 'common\models\User';
 public $serializer = [
 'class' => 'yii\rest\Serializer',
 'collectionEnvelope' => 'client_users',
 ];
 protected function verbs()
 {
  return [
          //'index' => ['GET', 'HEAD'],
          //'view' => ['GET', 'HEAD'],
          //'create' => ['POST'],
  'update' => ['POST', 'PATCH', 'PUT']
          //'delete' => ['DELETE'],
  ];
}

public function actions()
{
  $actions = parent::actions();
  unset($actions['create']);
  unset($actions['index']);
  unset($actions['update']);
  return $actions;
}   

     /**
     * Signs user up.
     *
     * @return mixed
     */
     public function actionCreate()
     {
      $model = new SignupForm();
      $params = Yii::$app->request->post();
      $model->username = $params['username'];
      $model->password = $params['password'];
      $model->email = $params['email'];

      

      if ($model->signup()) {
      //implement events
        $response['code'] = 201;
        $response['message'] = 'You are now a member!';
        $response['user'] =\common\models\User::findByUsername($model->username);
        return $response;   
      }
      else {

        $model->getErrors();
        $response['code'] = 401;
        $response['hasErrors'] = $model->hasErrors();
        $response['errors'] = $model->getErrors();
	            //return = $model;
        return $response;

      }
    }

    public function actionIndex(){
	 	//'user'=>\Yii::$app->user->identity;
     \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
     $users = new ActiveDataProvider([
       'query' => \common\models\User::find(),
       'pagination' => [
       'defaultPageSize' => 20,
       ],
       ]);
     return $users;
   }

      /**
     * User login.
     *
     * @return mixed
     */
      public function actionLogin(){
       $model = new LoginForm();
       $params = Yii::$app->request->post();
       $model->username = $params['username'];
       $model->password = $params['password'];
       if ($model->login()) {
         $response['code'] = 201;
         $response['message'] = 'You are now logged in!';
         $response['user'] = \common\models\User::findByUsername($model->username); 
             //filter the data to send back
             //add user event login
         return $response; 
       }
       else {
        $response['code'] = 401;
        $model->validate();
        $response['errors'] = $model->getErrors();
        return $response;
      }
    }

    public function actionDashboard()
    {
      $response = "You are logged in!";
      return $response;
    }

    public function actionUpdate()
    {
    //\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
      $attributes = Yii::$app->request->post();
    //$user = User::findIdentity($attributes['id']);
    //$user = $this->findModel($attributes['id']);
      $userId = $attributes['userId'];
      if (($model = User::findOne($userId)) !== null) {
        //$model->attributes = Yii::$app->request->post();
        if (isset($attributes['username'])) {
          $model->username = $attributes['username'];
        }

        if (isset($attributes['email'])) {
          $model->email = $attributes['email'];
        } 
        if (isset($attributes['full_name'])) {
          $model->full_name = $attributes['full_name'];
        } 

        if (isset($attributes['password'])) {
          $model->password = $attributes['password'];
        } 
        if (isset($attributes['phone'])) {
          $model->phone = $attributes['phone'];
        }
        
        $model->save();
        return array(
          'message'   => 'Your profile has been updated successfully',
          'code'      => 201,
          'userId'    => $userId
          );
      } else {
        return array(
          'message'   => 'An error occured while updating your profile',
          'code'      => 401
          );
      }

    }

  /**
   * Requests password reset.
   *
   * @return mixed
   */
  public function actionRequestPasswordReset()
  {
    $params = Yii::$app->request->post();
    $model = new PasswordResetRequestForm();
    $model->email = $params['email'];
    if ($model->validate()) {
      if ($model->sendEmail()) {
        return array(
          'message'   => 'Check your email for further instructions.',
          'code'      =>  201
          );
      } else {
        return array(
          'message'   => 'Sorry, we are unable to reset password for the provided email address.',
          'code'      => 401
          );
      }
    } else {
     return array(
      'message'   => 'Sorry, your email address is not valid.',
      'code'      => 401
      );
   }

 }

  /**
   * Resets password.
   *
   * @param string $token
   * @return mixed
   */
  public function actionResetPassword()
  {
    $attributes = Yii::$app->request->post();
    $token = $attributes['reset-token'];
    $newPassword = $attributes['password'];
    $model = new ResetPasswordForm($token);
    if ($model->validate() && $model->resetPassword()) {
      $response['message'] = 'New password saved successfully.';
      $response['code'] = 201;
    } else {
      $response['message'] = 'Error occurred while changing your password.';
      $response['code'] = 401;
    }

    return $response;
  }
}
