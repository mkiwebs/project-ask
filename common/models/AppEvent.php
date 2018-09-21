<?php

namespace common\models;

use Yii;
use yii\data\ActiveDataProvider;
/**
 * This is the model class for table "app_event".
 *
 * @property string $event_date
 * @property string $event_venue
 * @property string $event_address
 * @property string $event_phone
 * @property integer $event_image
 * @property string $description
 * @property string $related_category
 * @property integer $event_id
 */
class AppEvent extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'app_event';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['event_date', 'event_venue', 'event_address', 'event_phone', 'description', 'related_category'], 'required'],
            [['event_date'], 'safe'],
            [['event_address', 'description'], 'string'],
            [[ 'event_id'], 'integer'],
            [[ 'event_name'], 'string'],
            [['event_venue','event_image', 'related_category','event_date'], 'string', 'max' => 255],
            [['event_phone'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'event_date' => 'Event Date',
            'event_venue' => 'Venue',
            'event_address' => 'Address',
            'event_phone' => 'Contact Info',
            'event_image' => 'Event Banner',
            'description' => 'Description',
            'related_category' => 'Event Category',
            'event_id' => 'Event ID',
             'event_name' => 'Name',
        ];
    }

    public static function  recentEvents(){
        $query = self::find()->limit(5);
        // add conditions that should always apply here
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => false,
            'sort'=>[
                'defaultOrder'=>[
                    'event_id'=>SORT_DESC,
                ]
            ]
        ]);

        return $dataProvider;
    }
}
