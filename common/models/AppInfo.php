<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "app_info".
 *
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property string $date_added
 */
class AppInfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'app_info';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'title', 'content', 'date_added'], 'required'],
            [['id'], 'integer'],
            [['content'], 'string'],
            [['date_added'], 'safe'],
            [['title'], 'string', 'max' => 300],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'content' => 'Content',
            'date_added' => 'Date Added',
        ];
    }
}
