<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "follow_question".
 *
 * @property int $id
 * @property int $uid
 * @property int $quiz_id
 * @property string $addtime
 */
class FollowQuestion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'follow_question';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid'], 'required'],
            [['uid', 'quiz_id'], 'integer'],
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
            'uid' => 'Uid',
            'quiz_id' => 'Quiz ID',
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

    public static function likeExists($uid,$quiz_id)
    {
     
        $exists = 0;      
        $model = self::find()
            ->where( [ 'quiz_id' => (int)$quiz_id, 'uid' => (int)$uid ] )
            ->exists();
        if ( $model === true ) {
            $exists = 1;
        } 

        return $exists;
    }
}
