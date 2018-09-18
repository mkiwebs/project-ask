<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_feedback".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $email
 * @property string $message
 */
class UserFeedback extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_feedback';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'email', 'message'], 'required'],
            [['user_id'], 'integer'],
            [['message'], 'string'],
            [['email'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'email' => 'Email',
            'message' => 'Message',
        ];
    }

    public function getUser()
    {
       return  $this->hasOne(User::className(),['id' => 'user_id']);
    }
}
