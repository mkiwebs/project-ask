<?php

namespace backend\controllers;

use Yii;
use common\models\TrendingNews;
use common\models\TrendingNewsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
/**
 * TrendingNewsController implements the CRUD actions for TrendingNews model.
 */
class TrendingNewsController extends Controller
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
        'actions' => ['view','update', 'create', 'delete', 'index'],
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
     * Lists all TrendingNews models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TrendingNewsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            ]);
    }

    /**
     * Displays a single TrendingNews model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
            ]);
    }

    public function actionCreate() {
        $model = new TrendingNews(['scenario'=>'insert']);

        if ( $model->load ( Yii::$app->request->post () ) ) {

            $model->featuredFile = UploadedFile::getInstance ( $model , 'featuredFile' );

            if ( $model->featuredFile !== null ) {
                $ymd = date ( "Ymd" );
                $fileName = Yii::$app->security->generateRandomString ( 20 ) . '.' . $model->featuredFile->extension;
                $model->image_url = $ymd . '/' . $fileName;
            }


            $transaction = Yii::$app->db->beginTransaction ();

            try {
                if ( !$model->save () ) {
                    throw new \Exception ( 'Error Occoured' );
                }

                $model->upload ( $ymd , $fileName );

                $transaction->commit ();

                return $this->redirect ( [ 'view' , 'id' => $model->id ] );
            } catch ( \Exception $ex ) {
                $transaction->rollBack ();
            }
        }
        return $this->render ( 'create' , [
            'model' => $model ,
            ] );
    }

    public function actionUpdate( $id ) {
        $model = $this->findModel ( $id );

        if ( $model->load ( Yii::$app->request->post () ) ) {
            $model->featuredFile = UploadedFile::getInstance ( $model , 'featuredFile' );

            //$oldFile = '';
            $oldFile = $model->image_url;

            if ( $model->featuredFile !== null ) {

                $ymd = date ( "Ymd" );

                $fileName = Yii::$app->security->generateRandomString ( 20 ) . '.' . $model->featuredFile->extension;

                $model->image_url = $ymd . '/' . $fileName;

            }

            $transaction = Yii::$app->db->beginTransaction ();

            try {
                if ( !$model->save () ) {
                    throw new \Exception ( 'Model error' );
                }

                $model->upload ( $ymd , $fileName );

                $model->unlinkOldFile ( $oldFile );

                $transaction->commit ();
                return $this->redirect ( [ 'view' , 'id' => $model->id ] );
            } catch ( Exception $ex ) {
                $transaction->rollBack ();
            }
        }
        return $this->render ( 'update' , [
            'model' => $model ,
            ] );
    }

    /**
     * Deletes an existing TrendingNews model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TrendingNews model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TrendingNews the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TrendingNews::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
