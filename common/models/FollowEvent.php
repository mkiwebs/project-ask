<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "follow_event".
 *
 * @property int $id
 * @property int $uid
 * @property int $event_id
 * @property string $addtime
 */
class FollowEvent extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'follow_event';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid', 'event_id', 'addtime'], 'required'],
            [['uid', 'event_id'], 'integer'],
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
            'event_id' => 'Event ID',
            'addtime' => 'Addtime',
        ];
    }
}
