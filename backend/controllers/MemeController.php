<?php

namespace backend\controllers;

use Yii;
use common\models\Meme;
use common\models\MemeSearch;
use common\models\MemeComment;
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
                    'actions' => ['view','comment','update', 'create', 'delete', 'index'],
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

        $question = $this->findModel($id);

        if (isset($_POST['Meme']) ) {
            $answer = $_POST['Meme'];
            $model->meme_id = $id;
            $model->text_content = $answer['content'];
            $model->user_id =   Yii::$app->user->identity->id;
            if ($model->save()) {
               
               return $this->redirect(['view', 'id' => $id]);
            } else {
                return false;
            }
        } else {
            //$test = $_POST['Question'];
            return $this->render('comment', [
                'model' => $model,
                'question' => $question,
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
}
