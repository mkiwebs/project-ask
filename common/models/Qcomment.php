<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "q_comment".
 *
 * @property int $id
 * @property int $uid
 * @property string $addtime
 * @property string $content
 * @property int $dataid
 * @property int $pid
 * @property int $recomid
 * @property int $has_sub
 * @property int $status
 */
class Qcomment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'q_comment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['uid', 'addtime', 'content'], 'required'],
            [['uid', 'dataid', 'pid', 'recomid', 'has_sub', 'status'], 'integer'],
            [['content'], 'string'],
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
            'addtime' => 'Addtime',
            'content' => 'Content',
            'dataid' => 'Dataid',
            'pid' => 'Pid',
            'recomid' => 'Recomid',
            'has_sub' => 'Has Sub',
            'status' => 'Status',
        ];
    }
}
