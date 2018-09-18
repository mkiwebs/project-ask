<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\AuthAssignment;

/**
 * AuthAssignmentSearch represents the model behind the search form about `common\models\AuthAssignment`.
 */
class AuthAssignmentSearch extends AuthAssignment
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item_name', 'user_id','user.username'], 'safe'],
            [['created_at'], 'integer'],
        ];
    }

    public function attributes() 
    { 
      return array_merge(parent::attributes(), 
      [ 
        'user.username', 
      ]
      );
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
        $query = AuthAssignment::find();

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

        //$query->andWhere(['user_id' => $params['attribute']]);
        // grid filtering conditions
        $query->andFilterWhere([
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'item_name', $this->item_name])
            ->andFilterWhere(['like', 'user.username', $this->user_id]);

        return $dataProvider;
    }
}
