<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Forms;

/**
 * FormsSearch represents the model behind the search form of `app\models\Forms`.
 */
class FormsSearch extends Forms
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['caseid'], 'integer'],
            [['phonenum', 'name', 'location', 'tanggalwaktu', 'description', 'gambar', 'casedue', 'email', 'status'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Forms::find();

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
            'caseid' => $this->caseid,
            'tanggalwaktu' => $this->tanggalwaktu,
            'casedue' => $this->casedue,
        ]);

        $query->andFilterWhere(['like', 'phonenum', $this->phonenum])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'location', $this->location])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'gambar', $this->gambar])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
