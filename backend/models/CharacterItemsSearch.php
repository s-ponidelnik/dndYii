<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\CharacterItems;

/**
 * CharacterItemsSearch represents the model behind the search form of `common\models\CharacterItems`.
 */
class CharacterItemsSearch extends CharacterItems
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'character_id', 'item_id', 'count'], 'integer'],
            [['equip'], 'safe'],
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
        $query = CharacterItems::find();

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
            'character_id' => $this->character_id,
            'item_id' => $this->item_id,
            'count' => $this->count,
        ]);

        $query->andFilterWhere(['like', 'equip', $this->equip]);

        return $dataProvider;
    }
}
