<?php

namespace common\models;

use Yii;
use yii\db\Expression;
use yii\db\Query;
use yii\data\ActiveDataProvider;
/**
 * This is the model class for table "client_question".
 *
 * @property integer $id
 * @property string $username
 * @property string $content
 * @property string $date_added
 * @property string $date_updated
 * @property string $answered
 * @property string $answered_by
 * @property string $question_answer
 * @property string $answer_date
 * @property string $question_status
 */
class Question extends \yii\db\ActiveRecord
{
    
    //private $connection = Yii::$app->db;
    const STATUS_PENDING        = 0;
    const STATUS_DELETED        = 1;
    const STATUS_ANSWERED       = 2;
    const STATUS_ONHOLD         = 3;

    const EVENT_NEW_QUESTION = 'new-question';

    public function init() {
         // first parameter is the name of the event and second is the handler.
         $this->on(self::EVENT_NEW_QUESTION, [$this, 'saveToLog']);
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'client_question';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'content','question_category'], 'required'],
            [['content', 'question_answer'], 'string'],
            [['date_added', 'date_updated', 'answer_date'], 'safe'],
            [['username', 'answered_by'], 'string', 'max' => 11],
            [['answered'], 'string', 'max' => 2],
            [['question_category'], 'integer', 'max' => 11],
            [['question_status'], 'string', 'max' => 20],   
            [['answers','likes', 'followers'], 'integer'],
            //[['question_status', 'default', 'value' => self::STATUS_PENDING],'on'=>['create']],
            // [['question_status', 'default', 'value' => self::STATUS_PENDING],'on'=>['create']]
            ['question_status', 'default', 'value' => self::STATUS_PENDING]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'content' => 'Question',
            'date_added' => 'Date Added',
            'date_updated' => 'Date Updated',
            'answered' => 'Answered',
            'answered_by' => 'Answered By',
            'question_answer' => 'Question Answer',
            'answer_date' => 'Answer Date',
            'question_status' => 'Status',
            'answers' =>'Answers',
            'likes' =>'Likes',
            'followers' =>'Follows',
        ];
    }

    public function getTimetext()
    {
        return date("d M Y",strtotime( $this->date_added ) );
    }

    public function fields() {
        return [
            'id',
            'username',
            'content'=> function( $model ) {
                return trim( $model->content  );
            },
            'date_added' => function( $model ) {
                return date("d M Y",strtotime( $model->date_added ) );
            },
            'date_updated',
            'answered',
            'answered_by',
            'question_answer',
            'answer_date',
            'question_status',
            'followers',
            'category' => function ($model)
                          {
                            return $model->category->category_name;
                           },
            'answers' => function ($model) {
                            $count = QuestionAnswer::find()
                                      ->where(['question_id' => $model->id])
                                      ->count();
                            if ($count > 0  && $count == 1 ) {

                               $count = $count." Answer";

                            } elseif ($count > 1 ) {
                                $count = $count." Answers";
                            } else {
                                $count = " No Answer yet";
                            }
                            
                            return $count;
                        },
                'likes' => function ($model) {
                            $count = LikeQuestion::find()
                                      ->where(['question_id' => $model->id])
                                      ->count();
                            if ($count > 0  && $count == 1 ) {

                               $count = $count." Like";

                            } elseif ($count > 1 ) {
                                $count = $count." Likes";
                            } else {
                                $count = " No LIke yet";
                            }
                            
                            return $count;
                        },
                 'followers' => function ($model) {
                            $count = FollowQuestion::find()
                                      ->where(['quiz_id' => $model->id])
                                      ->count();
                            if ($count > 0  && $count == 1 ) {

                               $count = $count." Follow";

                            } elseif ($count > 1 ) {
                                $count = $count." follows";
                            } else {
                                $count = " No follow ";
                            }
                            
                            return $count;
                        }
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
              $this->date_added = date("YmdHis");
              $this->date_updated = date("YmdHis");
            } else {
               $this->date_updated = date("YmdHis");
               //$this->question_status = self::STATUS_ANSWERED;
            }
            
            return true;
        }
        else{
            return false;
        }
    }

    public function afterSave($insert,$changedAttributes)
    {
         if ($insert) {
            $app_log_model = new AppLog();
             $app_log_model->log_time = date("YmdHis");
             $app_log_model->log_activity = 'asked a question';
             $app_log_model->user_id = $this->username;
             $app_log_model->device = "1";
             if ($app_log_model->save()) {
                 return true;
             } else {
                //var_dump($app_log_model->getErrors());
                 return $app_log_model->getErrors() ;
             }
         }
        else{
            return false;
        }
    }

    public static function answerQuestion($id,$answer)
    {
        //update question answer
        $connection = Yii::$app->db;
        $query = $connection->createCommand()
                            ->update('client_question', [
                                'answered'          => '0',
                                'answered_by'       => Yii::$app->user->identity->id,
                                'question_answer'   => $answer,
                                'answer_date'       => date("YmdHis"),
                                'question_status'   => self::STATUS_ANSWERED
                                ],'id = '.$id)
                            ->execute();
        if ($query) {
            return true;
        } else {
            return false;
        }  
        //test if the query was true then return true else return false
    }

    /**
     *
     * @return Count new users within one day(today)
     */
    public  static  function  newQuestions(){
        $expression = new Expression('DATE(NOW()) - INTERVAL 1 DAY');
        $count = (new Query())
            ->from(self::tableName())
            ->where(['>=','date_added',$expression])
            ->count();
        return $count;
    }

    public static function  recentQuestions(){
        $query = self::find()->limit(5);
        // add conditions that should always apply here
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => false,
            'sort'=>[
                'defaultOrder'=>[
                    'id'=>SORT_DESC,
                ]
            ]
        ]);

        return $dataProvider;
    }

    public function getUser()
    {
       return  $this->hasOne(User::className(),['id' => 'username']);
    }

    public function getAnsweredby()
    {
       return  $this->hasOne(User::className(),['id' => 'answered_by']);
    }

    public function getCategory()
    {
        return  $this->hasOne(QuestionCategory::className(),['category_id' => 'question_category']);
    }

    public function saveToLog($event)
    {
       //assigning attributes
       // echo 'mail sent to admin using the event';
       $app_log_model = new AppLog();
       $app_log_model->log_time = date("YmdHis");
       $app_log_model->log_activity = 'asked a question';
       $app_log_model->user_id = $event->username;
       $app_log_model->device = "1";
       // $app_log_model->id = "1";

       //$app_log_model->save();
       if ($app_log_model->save()) {
           return true;
       } else {
          //var_dump($app_log_model->getErrors());
           return $app_log_model->getErrors() ;
       }
       
       //var_dump($app_log_model->attributes);
    }

    /**
     * @inheritdoc
     */
    public static function findQuestionById($id)
    {
        return static::findOne(['id' => $id])->content;
    }

    public function countAnswers($q_id){
        $count = QuestionAnswer::find()->select(['id'])->where(['question_id' => (int)$q_id])->count();
       // $sql = "SELECT COUNT(id) as comment_count FROM `meme_comment` WHERE dataid = 4";
        return $count;
    }

    public function countFollowers($q_id){
        $count = FollowQuestion::find()->select(['id'])->where(['quiz_id' => (int)$q_id])->count();
       // $sql = "SELECT COUNT(id) as comment_count FROM `meme_comment` WHERE dataid = 4";
        return $count;
    }
}
