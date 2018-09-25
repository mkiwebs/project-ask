<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "like_answer".
 *
 * @property int $id
 * @property int $uid
 * @property int $question_id
 * @property string $addtime
 */
class LikeAnswer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'like_answer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid', 'question_id'], 'required'],
            [['uid', 'question_id'], 'integer'],
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
            'question_id' => 'Question ID',
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
}
