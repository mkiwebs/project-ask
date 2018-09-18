<?php

namespace backend\controllers;

use Yii;
use common\models\BlogArticle;
use common\models\BlogArticleSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\UploadForm;
use yii\web\UploadedFile;
use yii\filters\AccessControl;
use yii\helpers\Arrayhelper;
use common\models\BlogCategory;
use yii\web\ForbiddenHttpException;
use app\components\LyfeyAccess;
/**
 * ArticleController implements the CRUD actions for BlogArticle model.
 */
class ArticleController extends Controller
{
    public $layout= '@app/views/layouts/admin';
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['updatetime','view','update', 'create', 'delete', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all BlogArticle models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BlogArticleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
       
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'categoryDropdown' => BlogArticle::categoryDropdown(),
        ]);
    }

    /**
     * Displays a single BlogArticle model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionUpdatetime( )
    {
      $json = array( );
      if (Yii::$app->request->isAjax) {
        $data = Yii::$app->request->post();
        $model = BlogArticle::findOne( (int)$data["id"] );
        $model->created_at = $model->created_at = date("YmdHis");

        if ($model->save()) {
           //$json['message'] = "Article date has been updated";
           $json['code']    = 200;
        } else {
            //$json['message'] = "Error occurred while updating Article date";
            $json['code']    = 401;
        }
      }

      \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

      return $json;
    }

    /**
     * Creates a new BlogArticle model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if ( LyfeyAccess::hasPermission('article/create')) {
            $model = new BlogArticle();

            if ($model->load(Yii::$app->request->post())) {
                $model->featuredFile = UploadedFile::getInstance($model, 'featuredFile');
                if ($model->upload()) {
                    // file is uploaded successfully
                    $model->save(false);
                    //$this->sendGCM( "New article", FCM_REG_ID );
                    $model->trigger(BlogArticle::EVENT_NEW_ARTICLE);
                    
                  return $this->redirect(['view', 'id' => $model->id]);  
                }
                
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        } else {
            throw new ForbiddenHttpException( LyfeyAccess::$permission_error );
            
        }
    }

    /**
     * Updates an existing BlogArticle model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
       // if ( LyfeyAccess::hasPermission('article/update')) {

              $model = new BlogArticle();

              $model = $this->findModel($id);

              if ($model->load(Yii::$app->request->post())) {
                  $model->featuredFile = UploadedFile::getInstance($model, 'featuredFile');
                  if(isset($model->featuredFile)){
                      $model->upload();
                      $model->save(false);
                      //$this->sendGCM( "New article", FCM_REG_ID );
                  } else {
                      // file is uploaded successfully
                      $model->save();
                      $model->trigger(BlogArticle::EVENT_EDIT_ARTICLE);
                  }
                    return $this->redirect(['view', 'id' => $model->id]);  
              } else {
                  return $this->render('update', [
                      'model' => $model,
                  ]);
              }

        // } else {

        //     throw new ForbiddenHttpException( LyfeyAccess::$permission_error );
            
        // }
    }

    /**
     * Deletes an existing BlogArticle model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
       if ( LyfeyAccess::hasPermission('article/create')) {
        
            $this->findModel($id)->delete();

            return $this->redirect(['index']);
        } else {

            throw new ForbiddenHttpException( LyfeyAccess::$permission_error );
            
        }
    }

    /**
     * Finds the BlogArticle model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BlogArticle the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BlogArticle::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionDo()
    {
                $uploadedFile=UploadedFile::getInstancesByName('img');
                    $img_info=[];
                    $name = 'img';

                foreach ($uploadedFile as $k=>$v){
                    if ($v === null || $v->hasError) {
                        return 'Image does not exist';
                    }
                    //创建时间
                    $ymd = date("Ymd");
                    //存储到本地的路径
                    $save_path = \Yii::getAlias('@webroot') . '/uploads/' . $ymd . '/';
                    //存储到数据库的地址
                    $save_url = '/uploads' . '/' . $ymd . '/';

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

    // private function sendGCM( $message, $id ) {

    //     $url = 'https://fcm.googleapis.com/fcm/send';

    //     $fields = array (
    //             'registration_ids' => array (
    //                     $id
    //             ),
    //             'data' => array (
    //                     "message" => $message
    //             )
    //     );
    //     $fields = json_encode ( $fields );

    //     $headers = array (
    //             'Authorization: key=' . FCM_SERVER_KEY,
    //             'Content-Type: application/json'
    //     );

    //     $ch = curl_init ();
    //     curl_setopt ( $ch, CURLOPT_URL, $url );
    //     curl_setopt ( $ch, CURLOPT_POST, true );
    //     curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
    //     curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
    //     curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );

    //     $result = curl_exec ( $ch );
    //     //echo $result;
    //     curl_close ( $ch );
    // }


  
}
