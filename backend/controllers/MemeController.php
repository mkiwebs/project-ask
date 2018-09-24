<?php

namespace backend\controllers;

use Yii;
use common\models\Meme;
use common\models\MemeSearch;
use common\models\MemeComment;
use common\models\MemeLike;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;


/**
 * MemeController implements the CRUD actions for Meme model.
 */
class MemeController extends Controller
{
    public $layout= '@app/views/layouts/admin';
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
        'access' => [
            'class' => \yii\filters\AccessControl::className(),
            'rules' => [
                [
                    'actions' => ['login', 'error'],
                    'allow' => true,
                ],
                [
                    'actions' => ['view','comment','update', 'create', 'delete','like', 'index'],
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
     * Lists all Meme models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MemeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Meme model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

     public function actionCreate()
        {
            $model = new Meme();

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                $model->memeImage = UploadedFile::getInstance($model, 'memeImage');
                if ($model->upload()) {
                    // file is uploaded successfully
                    $model->save(false);
                    //$model->trigger(BlogArticle::EVENT_NEW_ARTICLE);
                  return $this->redirect(['view', 'id' => $model->id]);  
                }
                
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }


    /**
     * Updates an existing Meme model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Meme model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    // public function actionComment($id)
    // {
    //     $this->findModel($id)->delete();

    //     return $this->redirect(['create']);
    // }
public function actionComment($id)
    {
        
        $model = new MemeComment();

        // if ($model->load(Yii::$app->request->post()) && $model->save()) {
        //     return $this->redirect(['view', 'id' => $model->id]);
        // } else {
        //     return $this->render('create', [
        //         'model' => $model,
        //     ]);
        // }

        $meme = $this->findModel($id);

        if (isset($_POST['Meme']) ) {
            $comment = $_POST['Meme'];
            $model->meme_id = $id;
            $model->text_content = $comment['content'];
            $model->user_id =   $answer['uid'];
            if ($model->save()) {
               
               return $this->redirect(['view', 'id' => $id]);
            } else {
                return false;
            }
        } else {
            //$test = $_POST['Question'];
            return $this->render('comment', [
                'model' => $model,
                'meme' => $meme,
            ]);
        }
    }


    public function actionLike($id)
    {
        
        $model = new MemeLike();

        // if ($model->load(Yii::$app->request->post()) && $model->save()) {
        //     return $this->redirect(['view', 'id' => $model->id]);
        // } else {
        //     return $this->render('create', [
        //         'model' => $model,
        //     ]);
        // }

        $question = $this->findModel($id);

        if (isset($_POST['MemeLike']) ) {
            $memelike = $_POST['MemeLike'];
            $model->meme_id = $id;
            $model->text_content = $memelike['uid'];
            if ($model->save()) {
               
               return $this->redirect(['view', 'id' => $id]);
            } else {
                return false;
            }
        } else {
            //$test = $_POST['Question'];
            return $this->render('like', [
                'model' => $model,
                'memelike' => $memelike,
            ]);
        }
    }

    /**
     * Finds the Meme model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Meme the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Meme::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function getMeme()
    {
        return  $this->hasOne(Meme::className(),['id' => 'meme_id']);
    }
    public function getMemeID()
    {
        return  $this->hasOne(Meme::className(),['id' => 'dataid']);
    }
}
