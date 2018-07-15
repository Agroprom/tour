<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\User;
use app\models\Transfers;

/**
 * UserSearch represents the model behind the search form of `app\models\User`.
 */
class UserSearch extends User
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username'], 'safe'],
            [['created_at'], 'integer'],
            [['balance'], 'number', 'min'=> -1000],
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
            'balance' => $this->balance,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username]);

        return $dataProvider;
    }
    
    /**
     * 
     * @param User $to
     * @param number $amount
     * @return boolean
     */
    public function transfer(User $to, $amount)
    {   
        //$amount *= $amount;
        if (User::findIdentity($to->username)) {
        $this->balance -= $amount;    
        $to->balance += $amount;
            if ($this->validate() && $to->validate()) {
            $this->save();    
            $to->save();
            $transfer = new Transfers();
            $transfer->amount = $amount;
            $transfer->from = $this->username;
            $transfer->to = $to->username;
            $transfer->save();
            return true;
            }
        }
        return false;            
    }

}
