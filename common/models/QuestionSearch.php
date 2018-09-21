<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Question;

/**
 * QuestionSearch represents the model behind the search form about `common\models\Question`.
 */
class QuestionSearch extends Question
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['username', 'content', 'date_added', 'date_updated', 'answered', 'answered_by', 'question_answer', 'answer_date', 'question_status'], 'safe'],
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
        $query = Question::find();

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
            'date_added' => $this->date_added,
            'date_updated' => $this->date_updated,
            'answer_date' => $this->answer_date,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'answered', $this->answered])
            ->andFilterWhere(['like', 'answered_by', $this->answered_by])
            ->andFilterWhere(['like', 'question_answer', $this->question_answer])
            ->andFilterWhere(['like', 'question_status', $this->question_status]);

        return $dataProvider;
    }
}
