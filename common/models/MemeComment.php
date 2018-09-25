<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "meme_comment".
 *
 * @property int $id
 * @property string $content
 * @property string $addtime
 * @property int $uid user id
 * @property int $dataid meme id
 * @property int $status 0=hide 1= show
 * @property int $recomid
 * @property int $pid
 * @property int $has_sub
 * @property int $likes
 */
class MemeComment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'meme_comment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content','uid'], 'required'],
            [['content'], 'string'],
            [['uid', 'dataid', 'status', 'recomid', 'pid', 'has_sub', 'likes'], 'integer'],
            [['addtime', 'date_updated'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'content' => 'Content',
            'addtime' => 'Addtime',
            'uid' => 'Username',
            'dataid' => 'Dataid',
            'status' => 'Status',
            'recomid' => 'Recomid',
            'pid' => 'Pid',
            'has_sub' => 'Has Sub',
            'likes' => 'Likes',
            'date_updated' => 'Date Updated',
        ];
    }
    public function getUser()
    {
          return  $this->hasOne(User::className(),['id' => 'uid']);
    }

public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ( $this->isNewRecord ) {

              //$this->user_id =   Yii::$app->user->identity->id;
              $this->addtime = $this->setTimeText();

            } else {
               $this->date_updated = $this->setTimeText();
            }
            
            return true;
        } else {

            return false;
        }
    }
    public function setTimeText() {

        return strtotime( date("YmdHis"));

    }
}
