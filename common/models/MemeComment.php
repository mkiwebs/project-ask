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
            [['content', 'addtime', 'uid', 'dataid'], 'required'],
            [['content'], 'string'],
            [['uid', 'dataid', 'status', 'recomid', 'pid', 'has_sub', 'likes'], 'integer'],
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
            'content' => 'Content',
            'addtime' => 'Addtime',
            'uid' => 'Username',
            'dataid' => 'Dataid',
            'status' => 'Status',
            'recomid' => 'Recomid',
            'pid' => 'Pid',
            'has_sub' => 'Has Sub',
            'likes' => 'Likes',
        ];
    }
}
