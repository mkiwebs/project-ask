<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "meme_like".
 *
 * @property int $id
 * @property int $uid
 * @property int $meme_id
 * @property string $addtime
 */
class MemeLike extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'meme_like';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid'], 'required'],
            [['uid', 'meme_id'], 'integer'],
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
            'meme_id' => 'Meme ID',
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

    public static function likeExists($uid,$meme_id)
    {
     
        $exists = 0;      
        $model = self::find()
            ->where( [ 'meme_id' => (int)$meme_id, 'uid' => (int)$uid ] )
            ->exists();
        if ( $model === true ) {
            $exists = 1;
        } 

        return $exists;
    }
}
