<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Qtest;

/**
 * QtestSearch represents the model behind the search form of `common\models\Qtest`.
 */
class QtestSearch extends Qtest
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'uid', 'comments', 'shares', 'likes', 'status', 'dataid'], 'integer'],
            [['addtime', 'image', 'content'], 'safe'],
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
        $query = Qtest::find();

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
            'uid' => $this->uid,
            'comments' => $this->comments,
            'shares' => $this->shares,
            'likes' => $this->likes,
            'status' => $this->status,
            'dataid' => $this->dataid,
        ]);

        $query->andFilterWhere(['like', 'addtime', $this->addtime])
            ->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'content', $this->content]);

        return $dataProvider;
    }
}
