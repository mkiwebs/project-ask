<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;


/**
 * This is the model class for table "question_category".
 *
 * @property integer $category_id
 * @property string $category_name
 */
class QuestionCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'question_category';
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

    public static function getQuestions()
    {
        
        return  $this->hasMany(Question::className(),['question_category' => 'category_id']);
    }

    public static function categoryDropdown()
    {
     return Arrayhelper::map(self::find()->orderBy('category_id')->asArray()->all(),'category_id','category_name');
    }

}
