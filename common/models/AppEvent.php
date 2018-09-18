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
    public $eventBanner;
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
            [['event_venue','event_image', 'related_category','event_date'], 'string', 'max' => 255],
            [['event_phone'], 'string', 'max' => 20],
            [['eventBanner'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
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

    public function upload()
    {
        if ($this->validate()) {
           $ymd = date("Ymd");
           $save_path = \Yii::getAlias('@backend') . '/web/uploads/' . $ymd . '/';
            if (!file_exists($save_path)) {
                mkdir($save_path, 0777, true);
            }

            $fileName = Yii::$app->security->generateRandomString(20);

            $this->eventBanner->saveAs($save_path . $fileName .'.' . $this->eventBanner->extension);
            $this->event_image = $ymd . '/'. $fileName . '.' . $this->eventBanner->extension;
            return true;
        } else {
            return false;
        }
    }
}
