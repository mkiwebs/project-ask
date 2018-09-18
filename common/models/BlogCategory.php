<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "blog_category".
 *
 * @property integer $category_id
 * @property string $category_name
 */
class BlogCategory extends \yii\db\ActiveRecord
{
    
    const EVENT_NEW_CATEGORY = 'new-category';
      public function init() {
         // first parameter is the name of the event and second is the handler.
         $this->on(self::EVENT_NEW_CATEGORY, [$this, 'saveToLog']);
      }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'blog_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_name'], 'required'],
            [['category_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'category_id' => 'Category ID',
            'category_name' => 'Category Name',
        ];
    }

    public function saveToLog($event)
    {
       //assigning attributes
       // echo 'mail sent to admin using the event';
       $app_log_model = new AppLog();
       $app_log_model->log_time = date("YmdHis");
       $app_log_model->log_activity = 'created a new category';
       $app_log_model->user_id = Yii::$app->user->identity->id;
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
}
