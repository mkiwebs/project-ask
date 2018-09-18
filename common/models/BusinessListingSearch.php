<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\BusinessListing;

/**
 * BusinessListingSearch represents the model behind the search form about `common\models\BusinessListing`.
 */
class BusinessListingSearch extends BusinessListing
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name', 'address', 'phone', 'website', 'established_year', 'vat', 'emp_range', 'description', 'schedule', 'products', 'category', 'logo'], 'safe'],
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
        $query = BusinessListing::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=>[
                'defaultOrder'=>[
                    'id'=>SORT_DESC,
                ]
            ]
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
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'website', $this->website])
            ->andFilterWhere(['like', 'established_year', $this->established_year])
            ->andFilterWhere(['like', 'vat', $this->vat])
            ->andFilterWhere(['like', 'emp_range', $this->emp_range])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'schedule', $this->schedule])
            ->andFilterWhere(['like', 'products', $this->products])
            ->andFilterWhere(['like', 'category', $this->category])
            ->andFilterWhere(['like', 'logo', $this->logo]);

        return $dataProvider;
    }
}
