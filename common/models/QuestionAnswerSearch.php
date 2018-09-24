<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\QuestionAnswer;

/**
 * QuestionAnswerSearch represents the model behind the search form about `common\models\QuestionAnswer`.
 */
class QuestionAnswerSearch extends QuestionAnswer
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'question_id', 'user_id', 'answer_date', 'date_modified', 'published', 'likes'], 'integer'],
            [['answer_content'], 'safe'],
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
        $query = QuestionAnswer::find();

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
            'question_id' => $this->question_id,
            'user_id' => $this->user_id,
            'answer_date' => $this->answer_date,
            'date_modified' => $this->date_modified,
            'published' => $this->published,
            'likes' => $this->likes,
        ]);

        $query->andFilterWhere(['like', 'answer_content', $this->answer_content]);

        return $dataProvider;
    }
}
