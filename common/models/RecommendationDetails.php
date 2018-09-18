<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "recommendation_details".
 *
 * @property integer $id
 * @property string $recommendation_code
 * @property string $recommedor_name
 * @property string $recommendation_person
 * @property integer $awarded_points
 */
class RecommendationDetails extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'recommendation_details';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['recommendation_code', 'recommedor_name', 'recommendation_person', 'awarded_points'], 'required'],
            [['awarded_points'], 'integer'],
            ['recommendation_person', 'unique', 'targetClass' => '\common\models\RecommendationDetails', 'message' => 'You have already claimed your Points.'],
            [['recommendation_code'], 'string', 'max' => 100],
            [['recommedor_name', 'recommendation_person'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'recommendation_code' => 'Recommendation Code',
            'recommedor_name' => 'Recommedor Name',
            'recommendation_person' => 'Recommendation Person',
            'awarded_points' => 'Awarded Points',
        ];
    }

    public function getRecommendor()
    {
       return  $this->hasOne(User::className(),['id' => 'recommedor_name']);
    }

    public function getRecommended()
    {
       return  $this->hasOne(User::className(),['id' => 'recommendation_person']);
    }
}
