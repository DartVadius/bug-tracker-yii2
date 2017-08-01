<?php

namespace app\modules\bugtracker\models\repositories;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\bugtracker\models\repositories\TicketMessages;

/**
 * TicketMessagesSearch represents the model behind the search form about `app\modules\bugtracker\models\repositories\TicketMessages`.
 */
class TicketMessagesSearch extends TicketMessages
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'ticket_id', 'user_id'], 'integer'],
            [['text', 'date'], 'safe'],
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
        $query = TicketMessages::find();

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
            'ticket_id' => $this->ticket_id,
            'user_id' => $this->user_id,
            'date' => $this->date,
        ]);

        $query->andFilterWhere(['like', 'text', $this->text]);

        return $dataProvider;
    }
}
