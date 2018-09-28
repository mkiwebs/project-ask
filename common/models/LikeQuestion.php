<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "like_question".
 *
 * @property int $id
 * @property int $question_id
 * @property int $uid
 * @property string $addtime
 */
class LikeQuestion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'like_question';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['question_id', 'uid'], 'required'],
            [['question_id', 'uid'], 'integer'],
            [['addtime'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'question_id' => 'Question ID',
            'uid' => 'Uid',
            'addtime' => 'Addtime',
        ];
    }

        public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ( $this->isNewRecord ) {

              //$this->user_id =   Yii::$app->user->identity->id;
              $this->addtime = $this->setTimeText();

            }
            return true;
        } else {

            return false;
        }
    }
    public function setTimeText() {

        return strtotime( date("YmdHis"));

    }

        //get username 
    public function getUser()
    {
       return  $this->hasOne(User::className(),['id' => 'uid']);
    }

    public static function likeExists($uid,$question_id)
    {
     
        $exists = 0;      
        $model = self::find()
            ->where( [ 'question_id' => (int)$question_id, 'uid' => (int)$uid ] )
            ->exists();
        if ( $model === true ) {
            $exists = 1;
        } 

        return $exists;
    }
}
