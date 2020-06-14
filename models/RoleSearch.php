<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\User;

/**
 * RoleSearch represents the model behind the search form of `app\models\User`.
 */

//class atau model dari user
//untuk search di admin roles
class RoleSearch extends User
{
    public static function tableName()
     {
         return 'User';
     }

    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'status','status_detail'], 'string'],
            [['username', 'auth_key', 'password', 'email'], 'safe'],
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
        $query = User::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);
        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'status_detail', $this->status_detail]);

        return $dataProvider;
    }
}
