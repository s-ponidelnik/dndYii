<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\CharacterItem;

/**
 * CharacterItemSearch represents the model behind the search form of `common\models\CharacterItem`.
 */
class CharacterItemSearch extends CharacterItem
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'character_id', 'item_id', 'item_type', 'count'], 'integer'],
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
        $query = CharacterItem::find();

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
            'item_type' => $this->item_type,
            'count' => $this->count,
        ]);

        return $dataProvider;
    }
}
