<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\BlogArticle;

/**
 * BlogArticleSearch represents the model behind the search form about `common\models\BlogArticle`.
 */
class BlogArticleSearch extends BlogArticle
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['article_title', 'article_content', 'created_at', 'draft', 'category', 'keywords', 'article_views', 'author', 'date_modified', 'images_url', 'related_articles'], 'safe'],
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
        $query = BlogArticle::find();

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
            'created_at' => $this->created_at,
            'date_modified' => $this->date_modified,
        ]);

        $query->andFilterWhere(['like', 'article_title', $this->article_title])
            ->andFilterWhere(['like', 'article_content', $this->article_content])
            ->andFilterWhere(['like', 'draft', $this->draft])
            ->andFilterWhere(['like', 'category', $this->category])
            ->andFilterWhere(['like', 'keywords', $this->keywords])
            ->andFilterWhere(['like', 'article_views', $this->article_views])
            ->andFilterWhere(['like', 'author', $this->author])
            ->andFilterWhere(['like', 'images_url', $this->images_url])
            ->andFilterWhere(['like', 'related_articles', $this->related_articles]);

        return $dataProvider;
    }
}
