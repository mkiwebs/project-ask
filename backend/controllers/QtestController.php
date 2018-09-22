<?php

namespace backend\controllers;

use Yii;
use common\models\Qtest;
use common\models\QtestSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * QtestController implements the CRUD actions for Qtest model.
 */
class QtestController extends Controller
{   public $layout= '@app/views/layouts/admin';
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Qtest models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new QtestSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    // public function actionComment($id){
    //     return $this->render('view', [
    //         'model' => $this->findModel($id),
    //     ]);
    // }

    /**
     * Displays a single Qtest model.
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

    /**
     * Creates a new Qtest model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    // public function actionCreate()
    // {
    //     $model = new Qtest();

    //     if ($model->load(Yii::$app->request->post()) && $model->save()) {
    //         return $this->redirect(['view', 'id' => $model->id]);
    //     }

    //     return $this->render('create', [
    //         'model' => $model,
    //     ]);
    // }

    public function actionCreate()
        {
            $model = new Qtest();

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                $model->questionImage = UploadedFile::getInstance($model, 'questionImage');
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
     * Updates an existing Qtest model.
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
     * Deletes an existing Qtest model.
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

    /**
     * Finds the Qtest model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Qtest the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Qtest::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


    public function actionComment($id)
    {
        
          $model = new Qtest();

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
}
