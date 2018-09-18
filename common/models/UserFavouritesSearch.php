<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\UserFavourites;

/**
 * UserFavouritesSearch represents the model behind the search form about `common\models\UserFavourites`.
 */
class UserFavouritesSearch extends UserFavourites
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fav_id', 'fav_type', 'user_id', 'item_id'], 'integer'],
            [['date_added'], 'safe'],
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
        $query = UserFavourites::find();

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
            'fav_id' => $this->fav_id,
            'fav_type' => $this->fav_type,
            'user_id' => $this->user_id,
            'item_id' => $this->item_id,
            'date_added' => $this->date_added,
        ]);

        return $dataProvider;
    }
}
