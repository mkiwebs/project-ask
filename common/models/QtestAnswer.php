<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "qtest_answer".
 *
 * @property int $id
 * @property int $uid user id
 * @property int $qid question id
 * @property int $content
 * @property int $addtime
 * @property int $likes
 * @property string $date_updated
 * @property int $status 0 pending 1 approved
 */
class QtestAnswer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'qtest_answer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid', 'qid', 'content', 'addtime'], 'required'],
            [['uid', 'qid', 'content', 'addtime', 'likes', 'status'], 'integer'],
            [['date_updated'], 'string', 'max' => 250],
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
            'qid' => 'Qid',
            'content' => 'Content',
            'addtime' => 'Addtime',
            'likes' => 'Likes',
            'date_updated' => 'Date Updated',
            'status' => 'Status',
        ];
    }
}
