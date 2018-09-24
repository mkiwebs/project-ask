<?php

namespace backend\controllers;

use Yii;
use common\models\FollowQuestion;
use common\models\FollowQuestionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FollowQuestionController implements the CRUD actions for FollowQuestion model.
 */
class FollowQuestionController extends Controller
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
     * Lists all FollowQuestion models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FollowQuestionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single FollowQuestion model.
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
     * Creates a new FollowQuestion model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
    //  */
    // public function actionCreate()
    // {
    //     $model = new FollowQuestion();

    //     if ($model->load(Yii::$app->request->post()) && $model->save()) {
    //         return $this->redirect(['view', 'id' => $model->id]);
    //     }

    //     return $this->render('create', [
    //         'model' => $model,
    //     ]);
    // }

    public function actionCreate()
    {
        
        if ( ! is_null( Yii::$app->request->get('id') ) &&  ! is_null( Yii::$app->request->get('question') )) {
            
            $question = str_replace('-', ' ', trim( Yii::$app->request->get('question') ) );

            $model = new FollowQuestion();

            $model->quiz_id = Yii::$app->request->get('id');
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                    'question' => $question,
                ]);
            }
        }  else {

                throw new NotFoundHttpException('The requested page does not exist.');
            }

    }

    /**
     * Updates an existing FollowQuestion model.
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
     * Deletes an existing FollowQuestion model.
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
     * Finds the FollowQuestion model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FollowQuestion the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FollowQuestion::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


}
