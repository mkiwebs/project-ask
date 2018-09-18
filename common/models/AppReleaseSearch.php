<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\AppRelease;

/**
 * AppReleaseSearch represents the model behind the search form about `common\models\AppRelease`.
 */
class AppReleaseSearch extends AppRelease
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['date_added', 'release_name','release_features', 'file_link', 'app_version', 'version_code'], 'safe'],
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
        $query = AppRelease::find();

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
            'date_added' => $this->date_added,
        ]);

        $query->andFilterWhere(['like', 'release_features', $this->release_features])
            ->andFilterWhere(['like', 'file_link', $this->file_link])
            ->andFilterWhere(['like', 'app_version', $this->app_version])
            ->andFilterWhere(['like', 'release_name', $this->release_name])
            ->andFilterWhere(['like', 'version_code', $this->version_code]);

        return $dataProvider;
    }
}
