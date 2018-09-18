<?php

namespace common\models;

use Yii;


/**
 * This is the model class for table "trending_news".
 *
 * @property integer $id
 * @property string $headline_text
 * @property string $image_url
 * @property string $news_info
 * @property string $news_url
 * @property string $author
 * @property string $published
 * @property string $date_added
 * @property string $date_modified
 */
class TrendingNews extends \yii\db\ActiveRecord
{
  const EVENT_ADD_TRENDING_NEWS = 'add-trending-news';
  //required on insert
  public $featuredFile;

  public function init() {
    $this->on(self::EVENT_ADD_TRENDING_NEWS, [$this, 'saveToLog']);
  }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
      return 'trending_news';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
      return [
      [['headline_text','news_info', 'news_url','published'], 'required'],
      [['headline_text', 'image_url', 'news_info', 'news_url'], 'string'],
      [['date_added', 'date_modified'], 'safe'],
      [['author'], 'string', 'max' => 20],
      [['published'], 'string', 'max' => 2],
      [[ 'featuredFile' ] , 'required' , 'on' => 'insert' ],
      [[ 'featuredFile' ] ,'file' ,'extensions' => 'png, jpg'] ,
      ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
      return [
      'id' => 'ID',
      'headline_text' => 'Headline',
      'image_url' => 'Image Url',
      'news_info' => 'Source',
      'news_url' => 'News Url',
      'author' => 'Author',
      'published' => 'Published',
      'date_added' => 'Date Added',
      'date_modified' => 'Date Modified',
      'featuredFile' => 'Featured Image',
      ];
    }

    // public function fields() {
    //     return [
    //         'id',
    //         'headline_text',
    //         'image_url',
    //         'news_info',
    //         'news_url',
    //         'date_added'=> function ($model) {
    //                         return date("d/m/Y",strtotime($model->date_added));
    //                     }
    //           ];
    // }

    public function uploadBanner()
    {
      if ($this->validate()) {
       $ymd = date("Ymd");
       $save_path = \Yii::getAlias('@backend') . '/web/uploads/' . $ymd . '/';
       if (!file_exists($save_path)) {
        mkdir($save_path, 0777, true);
      }
      $fileName = "trending_".Yii::$app->security->generateRandomString(20);
      $this->featuredFile->saveAs($save_path . $fileName .'.' . $this->featuredFile->extension);
      $this->image_url = $ymd . '/'. $fileName . '.' . $this->featuredFile->extension;
      return true;
    } else {
      return false;
    }
  }

  public function upload( $ymd , $fileName ) {
   if ( $this->featuredFile !== null && $this->featuredFile->name !== '' ) {
     $save_path = \Yii::getAlias ( '@backend' ) . '/web/uploads/' . $ymd . '/';
     if ( !file_exists ( $save_path ) ) {
       mkdir ( $save_path , 0777 , true );
     }

     if ( !$this->featuredFile->saveAs ( $save_path . $fileName ) ) {
       $this->addError ( 'featuredFile' , 'File could not be uploaded' );
       throw new \Exception ( 'File upload error' );
     }
   }
 }

 public function unlinkOldFile( $filename ) {
   if ( $filename !== '' ) {
     $save_path = \Yii::getAlias ( '@backend' ) . '/web/uploads/' . $filename;
     unlink ( $save_path );
   }
 }

   public function beforeSave($insert)
   {
    if (parent::beforeSave($insert)) {
      if ($this->isNewRecord) {
        $this->date_added = date("YmdHis");
        $this->author =   Yii::$app->user->identity->id;
      } 
      else {
       $this->date_modified = date("YmdHis"); 
     }
     return true;
   }
   else{
    return false;
  }
  }

  public function saveToLog($event)
  {
         //assigning attributes
         // echo 'mail sent to admin using the event';
   $app_log_model = new AppLog();
   $app_log_model->log_time = date("YmdHis");
   $app_log_model->log_activity = 'Added a trending news';
   $app_log_model->user_id = Yii::$app->user->identity->id;
   $app_log_model->device = "1";
   if ($app_log_model->save()) {
     return true;
   } else {
     return $app_log_model->getErrors() ;
   }
  }
  public function getDateadded()
  {
    return date( "jS M, Y", strtotime( $this->date_added ));
  }
  public function getPublishStatus()
  { 
    if($this->published === '1'){
      return "Published";
    } else {
      return "Draft";
    }
    
  }

  public function getUser()
  {
    return  $this->hasOne(User::className(),['id' => 'author']);
  }

}
