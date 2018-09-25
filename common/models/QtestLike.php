<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "qtest_like".
 *
 * @property int $id
 * @property int $uid
 * @property string $addtime
 * @property int $qid
 */
class QtestLike extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'qtest_like';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid'],'required'],
            [['uid', 'qid'], 'integer'],
            [['addtime'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'uid' => 'Username',
            'addtime' => 'Addtime',
            'qid' => 'Qid',
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
