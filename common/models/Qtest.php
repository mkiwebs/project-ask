<?php

namespace common\models;

use Yii;
use yii\db\Expression;
use yii\db\Query;

/**
 * This is the model class for table "qtest".
 *
 * @property int $id
 * @property int $uid
 * @property string $addtime
 * @property string $image
 * @property int $comments
 * @property int $shares
 * @property int $likes
 * @property int $status
 * @property string $content
 * @property int $dataid id of the shared content
 */
class Qtest extends \yii\db\ActiveRecord
{    public $questionImage;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'qtest';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid', 'content'], 'required'],
            [['uid', 'comments', 'shares', 'likes', 'status', 'dataid'], 'integer'],
            [['content'], 'string'],
            [['addtime','date_updated'], 'string', 'max' => 100],
            [['questionImage'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
        ];
    }

    public function upload()
        {
            if ($this->validate()) {
               $ymd = date("Ymd");
               $save_path = \Yii::getAlias('@backend') . '/web/uploads/' . $ymd . '/';
                if (!file_exists($save_path)) {
                    mkdir($save_path, 0777, true);
                }

                $fileName = Yii::$app->security->generateRandomString(20);

                $this->questionImage->saveAs($save_path . $fileName .'.' . $this->questionImage->extension);
                $this->image = $ymd . '/'. $fileName . '.' . $this->questionImage->extension;
                return true;
            } else {
                return false;
            }
        }

    public function getTimetext()
    {
        return date("d M Y",strtotime( $this->addtime ) );
    }
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
              $this->addtime = date("YmdHis");
              // $this->date_updated = date("YmdHis");
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
             $app_log_model->log_activity = 'Posted IQ question';
             $app_log_model->user_id = $this->uid;
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

    public function countAnswers($q_id){
        $count = QtestAnswer::find()->select(['id'])->where(['qid' => (int)$q_id])->count();
       // $sql = "SELECT COUNT(id) as comment_count FROM `meme_comment` WHERE dataid = 4";
        return $count;
    } 
    public function countLikes($q_id){
        $count = QtestLike::find()->select(['id'])->where(['qid' => (int)$q_id])->count();
       // $sql = "SELECT COUNT(id) as comment_count FROM `meme_comment` WHERE dataid = 4";
        return $count;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'uid' => 'Uid',
            'addtime' => 'Addtime',
            'image' => 'Image',
            'comments' => 'Comments',
            'shares' => 'Shares',
            'likes' => 'Likes',
            'status' => 'Status',
            'content' => 'Content',
            'dataid' => 'Dataid',
            'date_updated' => 'date_updated',
        ];
    }
    public function getUser()
    {
       return  $this->hasOne(User::className(),['id' => 'uid']);
    }


    //new IQ questions

    public  static  function  newquiz(){
        $expression = new Expression('DATE(NOW()) - INTERVAL 1 DAY');
        $count = (new Query())
            ->from(self::tableName())
            ->where(['>=','addtime',$expression])
            ->count();
        return $count;
    }
}
