<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Transfers;

/**
 * TransfersSearch represents the model behind the search form of `app\models\Transfers`.
 */
class TransfersSearch extends Transfers
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['from', 'to'], 'safe'],
            [['amount', 'date'], 'number'],
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
    public function search($username, $params)
    {
        $query = Transfers::find()->andWhere(['from' => $username])->orWhere(['to' => $username]);

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
            'amount' => $this->amount,
            'date' => $this->date,
        ]);

        $query->andFilterWhere(['like', 'from', $this->from])
            ->andFilterWhere(['like', 'to', $this->to]);

        return $dataProvider;
    }
       
}
