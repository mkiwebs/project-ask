<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "client_user_notification".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $notify_item
 * @property string $notification_value
 */
class UserNotification extends \yii\db\ActiveRecord
{
    const USER_EVENT_NOTIFICATION       = 1;
    const USER_ARTICLE_NOTIFICATION     = 1;
    const USER_QUESTION_NOTIFICATION    = 1;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'client_user_notification';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'notify_item', 'notification_value'], 'required'],
            [['user_id', 'notify_item'], 'integer'],
            [['notification_value'], 'string', 'max' => 10],
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
            'notify_item' => 'Notify Item',
            'notification_value' => 'Notification Value',
        ];
    }
}
