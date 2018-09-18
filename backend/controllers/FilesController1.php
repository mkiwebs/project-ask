<?php

namespace backend\controllers;

use Yii;
use common\models\UploadForm;
use yii\web\UploadedFile;
class FilesController extends \yii\web\Controller
{
   public function beforeAction($action)
       {
           if (in_array($action->id, ['summernote'])) {
               $this->enableCsrfValidation = false;
           }
           return parent::beforeAction($action);
       }


    public function actionManage()
    {
        return $this->render('manage');
    }

    public function actionDo()
    {
        		$uploadedFile = UploadedFile::getInstancesByName('img');
        	        $img_info=[];
        	        $name = 'img';

    	        foreach ($uploadedFile as $k=>$v){
    	            if ($v === null || $v->hasError) {
    	                return '文件不存在';
    	            }
    	            //创建时间
    	            $ymd = date("Ymd");
    	            //存储到本地的路径
    	            $save_path = \Yii::getAlias('@uploads') . '/images/' . $ymd . '/';
    	            //存储到数据库的地址
    	            $save_url = '/images' . '/' . $ymd . '/';

    	            if (!file_exists($save_path)) {
    	                mkdir($save_path, 0777, true);
    	            }
    	            //图片名称
    	            $file_name = $v->getBaseName();
    	            //图片格式
    	            $file_ext = $v->getExtension();
    	            //新文件名
    	            $new_file_name = date("YmdHis") . '_' . rand(10000, 99999) . '.' . $file_ext;
    	            //图片信息
    	            $v->saveAs($save_path . $new_file_name);
    	            $img_info[$name.'['.$k.']']=['path' => $save_path, 'url' => $save_url, 'name' => $file_name, 'new_name' => $new_file_name, 'ext' => $file_ext];
    	        }
            //返回一个数组 里面是每个图片的信息（如下：）
           return json_encode($img_info);
    }


    public function actionUpload()
    {
    	// $model = new UploadForm();

     //    if (Yii::$app->request->isPost) {
     //        $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
     //        if ($model->upload()) {
     //            // file is uploaded successfully
     //            var_dump($model->imageFile);
     //            return;
     //        }
     //    }
    		

        return $this->render('upload');
    }

    public function actionFilemodal()
    {
        $filter_name = null;
        $page = 1;
        //get the images folder
        $directory = \Yii::$app->params['DIR_IMAGES'];
        // Get directories
        $directories = glob($directory . '/*', GLOB_ONLYDIR);
        // Get files
        $files = glob($directory .'/20171219/'.'*.{jpg,jpeg,png,gif,JPG,JPEG,PNG,GIF}', GLOB_BRACE);
        //var_dump($directory);
        // Merge directories and files
        $images = array_merge($directories, $files);
        // Get total number of files and directories
        $image_total = count($images);
        // Split the array based on current page number and max number of items per page of 10
        $images = array_splice($images, ($page - 1) * 16, 16);
        $arrayName = array();
        foreach ($images as $image) {
            $name = str_split(basename($image), 14);
            if (is_dir($image)) {
                $arrayName['images'][] = array(
                'name'  => implode(' ', $name),
                'type'  => 'directory',
                'href'  => $image
                );
            } elseif (is_file($image)) { 
               $arrayName['images'][] = array(
                'name'  => implode(' ', $name),
                'type'  => 'image',
                'href'  => $image
                );

            }
        }
        //

        return $this->render('filemodal',[
                'images'=> $arrayName
            ]);
    }

    public function uploadSingleImage()
    {
        // $uploadedFile = UploadedFile::getInstanceByName('img');
        // $testName = Yii::$app->request->post('img');
            
        // if ($uploadedFile === null || $uploadedFile->hasError) {
        //             return 'File not found'.$testName;
        //     }
        // //create time
        // $ymd = date("Ymd");
        //    //absolute url to save images
        //    $save_path = \Yii::getAlias('@webroot') . '/uploads/' . $ymd . '/';
        //    //url to save in the database
        //    $save_url = '/uploads' . '/' . $ymd . '/';

        //    if (!file_exists($save_path)) {
        //        mkdir($save_path, 0777, true);
        //    }
        //    //image name
        //    $file_name = $uploadedFile->getBaseName();
        //    //image extension
        //    $file_ext = $uploadedFile->getExtension();
        //    //create new image name
        //    $new_file_name = date("YmdHis") . '_' . rand(10000, 99999) . '.' . $file_ext;
        //    //image information
        //    $uploadedFile->saveAs($save_path . $new_file_name);
        //    //return new url after upload
        //    return $save_url.$new_file_name;  
    }

    public function actionSummernote()
    {
        //$this->enableCsrfValidation = false; 

        //TODO List
        // 1) Rename the File
        // 2) For Multiple Upload , Loop through $_FILES
        // $dir_name = "summernote/";
                        $ymd = date("Ymd");
        //             //存储到本地的路径
                //$dir_name = \Yii::getAlias('@uploads') . '/images/' . $ymd . '/';
                $dir_name =    \Yii::getAlias('@webroot') . '/uploads/' . $ymd . '/';
           move_uploaded_file($_FILES['file']['tmp_name'],$dir_name.$_FILES['file']['name']);
           return "http://lyfey.ovicko.com/uploads/".$ymd.'/'.$_FILES['file']['name'];
           //return "http://localhost/projects/advanced/backend/web/uploads/".$ymd.'/'.$_FILES['file']['name'];
            //return $dir_name.$_FILES['file']['name'];
        // if (Yii::$app->request->isAjax) {
        //             $data = Yii::$app->request->post();
        //             $filesend = Yii::$app->request->post('file');
        //             $uploadedFile = UploadedFile::getInstancesByName('file');
        //             $img_info=[];
        //             $name = 'file';

        //         foreach ($uploadedFile as $k=>$v){
        //             if ($v === null || $v->hasError) {
        //                 return "Folder doesn't exist!";
        //             }
        //             //创建时间
        //             $ymd = date("Ymd");
        //             //存储到本地的路径
        //             $save_path = \Yii::getAlias('@uploads') . '/images/' . $ymd . '/';
        //             //存储到数据库的地址
        //             $save_url = '/images' . '/' . $ymd . '/';

        //             if (!file_exists($save_path)) {
        //                 mkdir($save_path, 0777, true);
        //             }
        //             //图片名称
        //             $file_name = $v->getBaseName();
        //             //图片格式
        //             $file_ext = $v->getExtension();
        //             //新文件名
        //             $new_file_name = date("YmdHis") . '_' . rand(10000, 99999) . '.' . $file_ext;
        //             //图片信息
        //             $v->saveAs($save_path . $new_file_name);
        //             $img_info[$name.'['.$k.']']=['path' => $save_path, 'url' => $save_url, 'name' => $file_name, 'new_name' => $new_file_name, 'ext' => $file_ext];
        //         }
        //      return json_encode($img_info['url']);
        //  }


    }



}
