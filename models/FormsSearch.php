<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Forms;

/**
 * FormsSearch represents the model behind the search form of `app\models\Forms`.
 */

//ini untuk search form di list form
class FormsSearch extends Forms
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['caseid'], 'integer'],
            [['phonenum', 'location', 'tanggalwaktu', 'description', 'casedue', 'email', 'status','supervisor'], 'safe'],
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
        //membuat query
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'caseid' => $this->caseid,
            'casedue' => $this->casedue,
        ]);

        $query->andFilterWhere(['like', 'phonenum', $this->phonenum])
            ->andFilterWhere(['like', 'location', $this->location])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'tanggalwaktu', $this->tanggalwaktu])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'supervisor', $this->supervisor])
            ;

        return $dataProvider;
    }
}
