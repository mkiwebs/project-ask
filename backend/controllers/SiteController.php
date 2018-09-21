<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\models\User;
use common\models\Meme;
use common\models\Qtest;
use common\models\Question;
use common\models\AppLog;
use common\models\BlogArticle;
use common\models\AppEvent;
/**
 * Site controller
 */
class SiteController extends Controller
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
                        'actions' => ['logout', 'mail', 'dashboard', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        $this->layout = 'adminLogin';
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionMail()
    {
        $subject = "Are you ok";
        \Yii::$app->mailer->compose('hello_mail',['form'=>'goHome'])
            ->setTo('4jpps@vmani.com')
            ->setFrom('victor@ovicko.com')
            ->setSubject($subject)
            ->send();
    }

    /**
     * Displays Dashboard.
     *
     * @return string
     */
    public function actionDashboard()
    {
       
        $new_users = User::newUsers();
        $new_questions = Question::newQuestions();
        $new_memes = Meme::newMemes();
        $new_IQs = Qtest::newquiz();
        //count all users
        $total_users = User::getTotalUsers();
        $online_users = User::usersOnline();
        //$recent_articles = BlogArticle::recentArticle();
        // $recent_app_logs = AppLog::recentAppLogs();
        $recent_app_events = AppEvent::recentEvents();
        //recent logs
        $recent_logs = AppLog::recentAppLogs();
        $recent_articles = BlogArticle::recentArticle();
        $recent_memes = Meme::recentMemes();
        //recent questions
        $recent_questions = Question::recentQuestions();
        return $this->render('dashboard',
            [
                'total_users' =>$total_users,
                'new_user_count' => $new_users,
                'online_users' => $online_users,
                'recentQuestions' => $recent_questions,
                'recent_logs' =>$recent_logs,
                'recent_articles' =>$recent_articles,
                'recent_memes' =>$recent_memes,
                'recent_events' => $recent_app_events,
                'new_questions'  => $new_questions,
                'new_memes'  => $new_memes,
                'new_IQs'  => $new_IQs
            ]);
    }
}
