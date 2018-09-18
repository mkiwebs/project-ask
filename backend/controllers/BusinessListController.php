<?php

namespace backend\controllers;

use Yii;
use common\models\BusinessListing;
use common\models\BusinessListingSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
/**
 * BusinessListController implements the CRUD actions for BusinessListing model.
 */
class BusinessListController extends Controller
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
     * Lists all BusinessListing models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BusinessListingSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BusinessListing model.
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
        $model = new BusinessListing();

        if ( $model->load ( Yii::$app->request->post () ) ) {

            // $model->featuredFile = UploadedFile::getInstance ( $model , 'featuredFile' );
            // $ymd = date ( "Ymd" );
            // if ( $model->featuredFile !== null ) {
                
            //     $fileName = Yii::$app->security->generateRandomString ( 20 ) . '.' . $model->featuredFile->extension;
            //     $model->logo = $ymd . '/' . $fileName;
            // }


            $transaction = Yii::$app->db->beginTransaction ();

            try {
                if ( !$model->save () ) {
                    throw new \Exception ( 'Error Occoured' );
                }

                //$model->upload ( $ymd , $fileName );

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

            $ymd = date ( "Ymd" );
            $oldFile = $model->logo;

            // if ( $model->featuredFile !== null ) {

            //     $fileName = Yii::$app->security->generateRandomString ( 20 ) . '.' . $model->featuredFile->extension;
            //     $model->upload ( $ymd , $fileName );
            //     $model->unlinkOldFile ( $oldFile );

            //     $model->logo = $ymd . '/' . $fileName;

            // }

            $transaction = Yii::$app->db->beginTransaction ();

            try {
                if ( !$model->save () ) {
                    throw new \Exception ( 'Model error' );
                }

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
     * Deletes an existing BusinessListing model.
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
     * Finds the BusinessListing model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BusinessListing the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BusinessListing::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
