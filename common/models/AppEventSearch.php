<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\AppEvent;

/**
 * AppEventSearch represents the model behind the search form about `common\models\AppEvent`.
 */
class AppEventSearch extends AppEvent
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['event_date', 'event_venue', 'event_name', 'event_address', 'event_phone', 'description', 'related_category'], 'safe'],
            [['event_image', 'event_id'], 'integer'],
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
        $query = AppEvent::find();

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
            'event_date' => $this->event_date,
            'event_image' => $this->event_image,
            'event_id' => $this->event_id,
        ]);

        $query->andFilterWhere(['like', 'event_venue', $this->event_venue])
            ->andFilterWhere(['like', 'event_address', $this->event_address])
            ->andFilterWhere(['like', 'event_phone', $this->event_phone])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'related_category', $this->related_category]);

        return $dataProvider;
    }
}
