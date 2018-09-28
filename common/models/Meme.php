<?php

namespace common\models;

use Yii;
use yii\db\Expression;
use yii\db\Query;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "meme".
 *
 * @property int $id meme_id
 * @property int $uid user id
 * @property string $addtime
 * @property string $meme_url image
 * @property int $likes
 * @property int $shares
 * @property int $comments
 * @property int $status 1=approved 0 = not approved
 * @property string $text_content
 * @property int $dataid id of the shared content
 */
class Meme extends \yii\db\ActiveRecord
{
    public $memeImage;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'meme';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid', 'text_content'], 'required'],
            [['uid', 'likes', 'shares', 'comments', 'status', 'dataid'], 'integer'],
            [['text_content'], 'string'],
            [['addtime','date_updated'], 'safe'],
            [['memeImage'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
        ];
    }

    public function getUser()
    {
       return  $this->hasOne(User::className(),['id' => 'uid']);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'uid' => 'Username',
            'addtime' => 'Addtime',
            'meme_url' => 'Image',
            'likes' => 'Likes',
            'shares' => 'Shares',
            'comments' => 'Comments',
            'status' => 'Status',
            'text_content' => 'Content',
            'dataid' => 'Dataid',
            'date_updated' => 'Date Updated',
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

            $this->memeImage->saveAs($save_path . $fileName .'.' . $this->memeImage->extension);
            $this->meme_url = $ymd . '/'. $fileName . '.' . $this->memeImage->extension;
            return true;
        } else {
            return false;
        }
    }

    public function fields() {
        return [
            'id',
            'uid',
            'text_content',
            'addtime'=> function ($model) {
                            return date("d/m/Y",strtotime($model->addtime));
                        },
            'meme_url',
            'likes',
            'shares' ,
            'comments',
            'comments' => function ($model) {
                            $count = MemeComment::find()
                                      ->where(['dataid' => $model->id])
                                      ->count();
                            if ($count > 0  && $count == 1 ) {

                               $count = $count." Comment";

                            } elseif ($count > 1 ) {
                                $count = $count." Comments";
                            } else {
                                $count = " No Comment yet";
                            }
                            
                            return $count;
                        },
            'status' ,
            'text_content' ,
            'dataid' ,
            'date_updated' ,

        ];
    }
    //meme comments
    /*
    **
    **
    *@param $dataid refers to the meme_id(FOREIGN KEY) in memecomment model
    *You get this?
    *
    *****/
    public function countComments($meme_id){
        $count = MemeComment::find()->select(['id'])->where(['dataid' => (int)$meme_id])->count();
       // $sql = "SELECT COUNT(id) as comment_count FROM `meme_comment` WHERE dataid = 4";
        return $count;
    }    
    public function countLikes($meme_id){
        $count = MemeLike::find()->select(['id'])->where(['meme_id' => (int)$meme_id])->count();
       // $sql = "SELECT COUNT(id) as comment_count FROM `meme_comment` WHERE dataid = 4";
        return $count;
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
    public  static  function  newMemes(){
        $expression = new Expression('DATE(NOW()) - INTERVAL 1 DAY');
        $count = (new Query())
            ->from(self::tableName())
            ->where(['>=','addtime',$expression])
            ->count();
        return $count;
    }

    public static function  recentMemes(){
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
}
