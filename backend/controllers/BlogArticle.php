<?php

namespace common\models;

use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\Arrayhelper;
use common\models\BlogCategory;
/**
 * This is the model class for table "blog_article".
 *
 * @property integer $id
 * @property string $article_title
 * @property string $article_content
 * @property string $created_at
 * @property string $draft
 * @property string $category
 * @property string $keywords
 * @property string $article_views
 * @property string $author
 * @property string $date_modified
 * @property string $images_url
 * @property string $related_articles
 */
class BlogArticle extends \yii\db\ActiveRecord
{
    const EVENT_NEW_ARTICLE = 'new-article';
    const EVENT_EDIT_ARTICLE = 'edit-article';
      public $featuredFile;
      public $liked;
      public function init() {
         // first parameter is the name of the event and second is the handler.
         $this->on(self::EVENT_NEW_ARTICLE, [$this, 'saveToLog']);
         $this->on(self::EVENT_EDIT_ARTICLE, [$this, 'blogEdited']);
      }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'blog_article';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['article_title', 'article_content', 'category', 'keywords'], 'required'],
            [['article_content', 'images_url'], 'string'],
            [['created_at', 'date_modified'], 'safe'],
            [['article_title', 'draft', 'keywords'], 'string', 'max' => 255],
            [['category', 'related_articles'], 'string', 'max' => 100],
            [['article_views'], 'string', 'max' => 11],
            [['author'], 'string', 'max' => 10],
            [['featuredFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
        ];
    }

    public static function ArticleTags()
    {
      
      $data = array();
       //fetch all tags
      $model = BlogArticle::find()
           ->select('keywords')
           //->where(['draft' => 1])
           ->all();
      $model_count = count( $model );

      if ( $model_count   > 0 ) {

          foreach ($model as $value) {
             $data[] = $value["keywords"];
          }

          $add_comma = strtolower( implode(" ,", $data ));

          $data['tags_list']['tags'] = array_unique( explode(",",str_replace(' ', '', $add_comma)  ) );
            
      } else {
          $data['tags_list'] = array(
            'tags' => array("Lyfey","Kenya")
          );

      }

      return $data['tags_list'];

    }

    public function fields() {
        return [
            'id',
            "created_at",
            "category",
            "keywords",
            "article_views",
            "author",
            "date_modified",
            "images_url",
            "liked",
            "related_articles",
            "article_title",
            "article_content" => function ( $model ) {

                          $content =  $this->webViewHeader();

                          $content .= $model->article_content;

                          $content .= $this->webViewFooter();

                            return $content;
                        },
            "article_likes" => function ( $model ) {

                          $count =  AppLikes::find()
                                              ->where(['item_id'=> (int)$model->id,'item_type'=> 'article'])
                                              ->count();

                            return (int)$count;
                        }

        ];
    }

    public function webViewHeader()
    {
     
     $header_html = '<!doctype html>
      <html lang="en">
        <head>
          <!-- Required meta tags -->
          <meta charset="utf-8">
          <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0 user-scalable=no">
          <meta name="apple-mobile-web-capable" content="yes">
          <meta name="apple-mobile-web-status-bar-style" content="black">
          <meta name="format-detection" content="telephone=no">
          <!-- Optional JavaScript -->
          <!-- jQuery first, then Popper.js, then Bootstrap JS -->
          <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
          <!-- Bootstrap CSS -->
          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">  
        </head>
        <style type="text/css">
            html {
                font-size: 30% 
            }
        </style>
          <body style="min-width: 320px; max-width: 640px; margin: 0 auto;">
            <div class="container">';

      return $header_html;
    }

    public function webViewFooter()
    {
      
        $footer_html = ' </div>
       <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
       <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
       </script>
       </body></html>';

      return $footer_html;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'article_title' => 'Article Title',
            'article_content' => 'Article Content',
            'created_at' => 'Created At',
            'draft' => 'Draft',
            'category' => 'Category',
            'keywords' => 'Keywords',
            'article_views' => 'Article Views',
            'author' => 'Author',
            'date_modified' => 'Date Modified',
            'images_url' => 'Featured Image',
            'related_articles' => 'article ids as objects',
        ];
    }

   public function getBlogCategory()
    {
         return  $this->hasOne(BlogCategory::className(),['category_id' => 'category']);
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
              $this->created_at = date("YmdHis");
              $this->author =   Yii::$app->user->identity->id;
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
       $app_log_model->log_activity = 'created a new article';
       $app_log_model->user_id = Yii::$app->user->identity->id;
       $app_log_model->device = "1";

       //$app_log_model->save();
       if ($app_log_model->save()) {
           return true;
       } else {
          //var_dump($app_log_model->getErrors());
           return $app_log_model->getErrors() ;
       }
       
       //var_dump($app_log_model->attributes);
    }

    public function blogEdited($event)
    {
       //assigning attributes
       // echo 'mail sent to admin using the event';
       $app_log_model = new AppLog();
       $app_log_model->log_time = date("YmdHis");
       $app_log_model->log_activity = 'Edited blog article';
       $app_log_model->user_id = Yii::$app->user->identity->id;
       $app_log_model->device = "2";
       if ($app_log_model->save()) {
           return true;
       } else {
           return $app_log_model->getErrors() ;
       }
    }

    public static function  recentArticle(){
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
       return  $this->hasOne(User::className(),['id' => 'author']);
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

            $this->featuredFile->saveAs($save_path . $fileName .'.' . $this->featuredFile->extension);
            $this->images_url = $ymd . '/'. $fileName . '.' . $this->featuredFile->extension;
            return true;
        } else {
            return false;
        }
    }

    public static function setCreateAt( $id )
    {
       
       $model = static::findOne(['id' => $id]);
       $model->created_at = $this->created_at = date("YmdHis");
        return $model;
    }

    public static function categoryDropdown()
    {
     return Arrayhelper::map(BlogCategory::find()->orderBy('category_id')->asArray()->all(),'category_id','category_name');
    }


}
