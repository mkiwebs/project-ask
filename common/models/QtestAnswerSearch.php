<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\QtestAnswer;

/**
 * QtestAnswerSearch represents the model behind the search form of `common\models\QtestAnswer`.
 */
class QtestAnswerSearch extends QtestAnswer
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'uid', 'qid', 'content', 'addtime', 'likes', 'status'], 'integer'],
            [['date_updated'], 'safe'],
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
        $query = QtestAnswer::find();

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
            'qid' => $this->qid,
            'content' => $this->content,
            'addtime' => $this->addtime,
            'likes' => $this->likes,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'date_updated', $this->date_updated]);

        return $dataProvider;
    }
}
