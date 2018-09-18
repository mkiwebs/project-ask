<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_request".
 *
 * @property integer $id
 * @property string $user_ip
 * @property string $user_agent
 * @property string $user_remote_ip
 * @property integer $user_id
 */
class UserRequest extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_request';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_ip', 'user_agent', 'user_remote_ip', 'user_id'], 'required'],
            [['user_ip', 'user_agent', 'user_remote_ip'], 'string'],
            [['user_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_ip' => 'User Ip',
            'user_agent' => 'User Agent',
            'user_remote_ip' => 'User Remote Ip',
            'user_id' => 'User ID',
        ];
    }

    public function getUser()
    {
        return  $this->hasOne(User::className(),['id' => 'user_id']);
    }
}
