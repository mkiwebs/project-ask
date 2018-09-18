<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "client_user".
 *
 * @property integer $id
 * @property string $full_name
 * @property string $username
 * @property string $email
 * @property string $auth_key
 * @property string $facebook_id
 * @property string $facebook_name
 * @property string $google_id
 * @property string $created_at
 * @property string $favourite_question
 * @property string $phone
 * @property integer $status
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $date_modified
 * @property string $updated_at
 */
class ClientUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'client_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['full_name', 'username', 'email', 'auth_key', 'facebook_id', 'facebook_name', 'google_id', 'created_at', 'favourite_question', 'phone', 'status', 'password_hash', 'password_reset_token', 'date_modified', 'updated_at'], 'required'],
            [['created_at', 'date_modified', 'updated_at'], 'safe'],
            [['status'], 'integer'],
            [['full_name', 'username', 'email', 'auth_key', 'facebook_id', 'facebook_name', 'google_id', 'password_hash', 'password_reset_token'], 'string', 'max' => 255],
            [['favourite_question'], 'string', 'max' => 20],
            [['phone'], 'string', 'max' => 11],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'full_name' => 'Full Name',
            'username' => 'Username',
            'email' => 'Email',
            'auth_key' => 'Auth Key',
            'facebook_id' => 'Facebook ID',
            'facebook_name' => 'Facebook Name',
            'google_id' => 'Google ID',
            'created_at' => 'Created At',
            'favourite_question' => 'Favourite Question',
            'phone' => 'Phone',
            'status' => 'Status',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'date_modified' => 'Date Modified',
            'updated_at' => 'Updated At',
        ];
    }
}
