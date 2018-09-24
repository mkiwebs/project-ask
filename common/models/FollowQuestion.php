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
            [['uid', 'quiz_id', 'addtime'], 'required'],
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
}
