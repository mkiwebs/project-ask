<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
/**
 * This is the model class for table "app_log".
 *
 * @property integer $id
 * @property string $log_time
 * @property integer $log_activity
 * @property integer $user_id
 * @property string $device
 */
class AppLog extends \yii\db\ActiveRecord
{
    
       // public $log_time;
       // public $log_time;
       // public $user_id;
       // public $device;
       // public $log_activity;
     /*
       @inheritdoc
     */
    public static function tableName()
    {
        return 'app_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['log_time', 'log_activity', 'user_id', 'device'], 'required'],
            [['log_time'], 'safe'],
            [['user_id'], 'integer'],
            [['log_activity'], 'string'],
            [['device'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'log_time' => 'Log Time',
            'log_activity' => 'Log Activity',
            'user_id' => 'User ID',
            'device' => 'Device',
        ];
    }

    public static function  recentAppLogs(){
        $query = self::find()->limit(5);
        // add conditions that should always apply here
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => false,
            'sort'=>[
                'defaultOrder'=>[
                    'id'=>SORT_DESC,
                ]
            ]
        ]);

        return $dataProvider;
    }

    public function getUser()
    {
       return  $this->hasOne(User::className(),['id' => 'user_id']);
    }
}
