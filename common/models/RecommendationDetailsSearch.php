<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\RecommendationDetails;

/**
 * RecommendationDetailsSearch represents the model behind the search form about `common\models\RecommendationDetails`.
 */
class RecommendationDetailsSearch extends RecommendationDetails
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'awarded_points'], 'integer'],
            [['recommendation_code', 'recommedor_name', 'recommended_person'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = RecommendationDetails::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'awarded_points' => $this->awarded_points,
        ]);

        $query->andFilterWhere(['like', 'recommendation_code', $this->recommendation_code])
            ->andFilterWhere(['like', 'recommedor_name', $this->recommedor_name])
            ->andFilterWhere(['like', 'recommended_person', $this->recommended_person]);

        return $dataProvider;
    }
}
