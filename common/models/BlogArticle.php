<?php

namespace common\models;

use Yii;
use yii\data\ActiveDataProvider;
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
      public function init() {
         // first parameter is the name of the event and second is the handler.
         $this->on(self::EVENT_NEW_ARTICLE, [$this, 'saveToLog']);
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
        ];
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
            'images_url' => 'the absolute url to the articles image',
            'related_articles' => 'article ids as objects',
        ];
    }

   public function getCategory()
    {
       return  $this->hasOne(Category::className(),['category_id' => 'category']);
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

    
}
