<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "recommendation_details".
 *
 * @property integer $id
 * @property string $recommendation_code
 * @property string $recommedor_name
 * @property string $recommended_person
 * @property integer $awarded_points
 */
class RecommendationDetails extends \yii\db\ActiveRecord
{
   const USER_RECOMMEND_POINTS = 5;

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
            [['recommendation_code', 'recommedor_name', 'recommended_person', 'awarded_points'], 'required'],
            ['recommended_person', 'unique', 'targetClass' => '\common\models\RecommendationDetails', 'message' => 'You have already claimed your Points.'],
            [['awarded_points'], 'integer'],
            [['recommendation_code'], 'string', 'max' => 100],
            [['recommedor_name', 'recommended_person'], 'string', 'max' => 255],
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
            'recommended_person' => 'Recommended Person',
            'awarded_points' => 'Awarded Points',
        ];
    }
}
