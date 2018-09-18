<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "question_answer".
 *
 * @property integer $id
 * @property integer $question_id
 * @property integer $user_id
 * @property string $answer_content
 * @property integer $answer_date
 * @property integer $date_modified
 * @property integer $published
 * @property integer $likes
 */
class QuestionAnswer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'question_answer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['question_id','answer_content'], 'required'],
            [['question_id', 'user_id', 'answer_date', 'date_modified', 'published', 'likes'], 'integer'],
            [['answer_content'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'question_id' => 'Question',
            'user_id' => 'Answered By',
            'answer_content' => 'Answer',
            'answer_date' => 'Date Answered',
            'date_modified' => 'Date Modified',
            'published' => 'Published',
            'likes' => 'Likes',
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ( $this->isNewRecord ) {

              //$this->user_id =   Yii::$app->user->identity->id;
              $this->answer_date = $this->setTimeText();

            } else {
               $this->date_modified = $this->setTimeText();
            }
            
            return true;
        } else {

            return false;
        }
    }

    public function getUser()
    {
          return  $this->hasOne(User::className(),['id' => 'user_id']);
    }

    public function setTimeText() {

        return strtotime( date("YmdHis"));

    }

    
    public function getQuestion()
    {
        return  $this->hasOne(Question::className(),['id' => 'question_id']);
    }
}
