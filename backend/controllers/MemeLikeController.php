<?php

namespace backend\controllers;

use Yii;
use common\models\MemeLike;
use common\models\MemeLikeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MemeLikeController implements the CRUD actions for MemeLike model.
 */
class MemeLikeController extends Controller
{
    public $layout= '@app/views/layouts/admin';
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
     * Lists all MemeLike models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MemeLikeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MemeLike model.
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
     * Creates a new MemeLike model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        
        if ( ! is_null( Yii::$app->request->get('id') ) &&  ! is_null( Yii::$app->request->get('meme') )) {
            
            $meme = str_replace('-', ' ', trim( Yii::$app->request->get('meme') ) );

            $model = new MemeLike();

            $model->meme_id = Yii::$app->request->get('id');
            // $model->user_id =   Yii::$app->user->identity->id;

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                    'meme' => $meme,
                ]);
            }
        }  else {

                throw new NotFoundHttpException('The requested page does not exist.');
            }

    }

    /**
     * Updates an existing MemeLike model.
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
     * Deletes an existing MemeLike model.
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
     * Finds the MemeLike model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return MemeLike the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MemeLike::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
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

        $meme = $this->findModel($id);

        if (isset($_POST['Question']) ) {
            $like = $_POST['Meme'];
            $model->meme_id = $id;
            $model->answer_content = $answer['uid'];
            $model->user_id =   Yii::$app->user->identity->id;
            if ($model->save()) {
               
               return $this->redirect(['view', 'id' => $id]);
            } else {
                return false;
            }
        } else {
            //$test = $_POST['Question'];
            return $this->render('like', [
                'model' => $model,
                'question' => $question,
            ]);
        }
    }
}
