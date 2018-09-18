<?php

namespace common\models;

use Yii;

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
 */
class BlogArticle extends \yii\db\ActiveRecord
{
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
            [['article_title', 'article_content','draft', 'category'], 'required'],
            [['article_content'], 'string'],
            [['created_at'], 'safe'],
            [['article_title','article_views','draft', 'keywords'], 'string', 'max' => 255],
            [['category'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'article_title' => 'Title',
            'article_content' => 'Content',
            'created_at' => 'Created At',
            'draft' => 'Draft',
            'category' => 'Category',
            'keywords' => 'Keywords',
            'article_views' => 'Views'
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
            }
            return true;
        }
        else{
            return false;
        }
    }
}
