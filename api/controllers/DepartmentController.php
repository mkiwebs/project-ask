<?php

namespace api\controllers;

use Yii;
use yii\rest\ActiveController;
use common\models\Department;
use yii\data\ActiveDataProvider;
/**
 * Departmentcontroller
 */
class DepartmentController extends ActiveController
{
 public $modelClass = 'common\models\Department';
 public $serializer = [
        'class' => 'yii\rest\Serializer',
        //'class' => 'api\components\ApiSerializer',
        'collectionEnvelope' => 'app_departments',
    ];

  public function actions()
  {
      $actions = parent::actions();
      unset($actions['create']);
      unset($actions['index']);
      return $actions;
  } 
 /*  
  public function actionIndex() 
{
   return new \yii\data\ActiveDataProvider([
        'query' => Department::find()->where(['dept_id' => 1]),
   ]);
}*/
 
     public function actionIndex(){
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $departments = new ActiveDataProvider([
            'query' => \common\models\Department::find(),
            'pagination' => [
                'defaultPageSize' => 6,
            ],
        ]);
        return $departments;
    }

         /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Department();
        $params = Yii::$app->request->post();
        $model->dept_name = $params['dept_name'];
        $model->dept_user=$params['dept_user'];
        $uploadedStrings = $params['upload_files'];

        //$fileLoc= "http://192.168.1.100/projects/YiiRestful/api/web/images.txt";
        $fileLoc= getenv("DOCUMENT_ROOT")."images.txt";
        $file = fopen($fileLoc,"w");
        $content = $uploadedStrings;
        fwrite($file, $content);
        fclose($file);
       
   /*    for ($i=0; $i < $uploadedStrings.length(); $i++) { 
       	   $path = "uploads/$image[$i].png"
       	   file_put_contents($path,base64_decode($uploadedStrings[$i]));
       }
*/

        
    
		if ($model->save()) {
          $response['isSuccess'] = 201;
          $response['message'] = 'A new Department added!';
		    return $response;   
		    }
	  else {

      $model->getErrors();
      $response['isSuccess'] = 401;
      $response['hasErrors'] = $model->hasErrors();
      $response['message'] = $model->getErrors();
      $response['errors'] = $model->getErrors();
	            //return = $model;
              return $response;

	        }
	}

  /*Uploading documents*/ 
   //    public function actionUploading() {  

   //       $uploads = \yii\web\UploadedFile::getInstanceByName('upfile');

   //       //print_r($uploads);exit;

   //        // if (empty($uploads)){
   //        //     return "Must upload at least 1 file in upfile form-data POST";
   //        // } 
   //        //   $response = array();

            
   //        //     foreach ($uploads as $file){
   //        //     $filename = $uploads->name;
   //        //     $path = "http://localhost/projects/YiiRestful/api/web/uploads/".$filename;
   //        //     //; 
   //        //     // 
   //        //     if ($uploads) {
   //        //         $response['message'] = "File uploaded";
   //        //         $response['file'] = $uploads;
   //        //         $response['extendtion'] = $file;
   //        //         $response['upload_dir'] = $path;
   //        //           }
   //        //       else {
   //        //         $response['message'] = "File not uploaded!";
   //        //       }
   //        //   } 
   //       \yii::$app->request->enableCsrfValidation = false;
   // foreach ($uploads as $file){
   //    $filename = $uploads->name;
   //  $path = "http://localhost/projects/YiiRestful/api/web/uploads/".$filename;
   // $putdata = fopen("php://input", "r");
   // // make sure that you have /web/upload directory (writeable) 
   // // for this to work
   // $path = "uploads/".$filename;

   // $fp = fopen($path, "w");

   // while ($data = fread($putdata, 1024))
   //    fwrite($fp, $data);

   // /* Close the streams */
   // fclose($fp);
   // fclose($putdata);
   //        //return $response;
          
   //     }}

  /*Uploading documents*/ 
      public function actionUploading() {  

         $uploads = \yii\web\UploadedFile::getInstanceByName('upfile');

         \yii::$app->request->enableCsrfValidation = false;
           //foreach ($uploads as $file){
          $filename = $uploads->name;
          $path = "http://localhost/projects/YiiRestful/api/web/uploads/".$filename;
           $putdata = fopen("php://input", "r");
           // make sure that you have /web/upload directory (writeable) 
           // for this to work
           $path = "uploads/".$filename;

           $fp = fopen($path, "w");

           while ($data = fread($putdata, 1024))
              fwrite($fp, $data);

           /* Close the streams */
           fclose($fp);
           fclose($putdata);
        //}
     }
}
