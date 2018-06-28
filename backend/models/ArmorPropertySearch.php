<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ArmorProperty;

/**
 * ArmorPropertySearch represents the model behind the search form of `common\models\ArmorProperty`.
 */
class ArmorPropertySearch extends ArmorProperty
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'item_id', 'type_id', 'ac', 'str', 'dex_mod_limit'], 'integer'],
            [['stealth_disadvantage', 'dex_mod'], 'safe'],
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
        $query = ArmorProperty::find();

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
            'item_id' => $this->item_id,
            'type_id' => $this->type_id,
            'ac' => $this->ac,
            'str' => $this->str,
            'dex_mod_limit' => $this->dex_mod_limit,
        ]);

        $query->andFilterWhere(['like', 'stealth_disadvantage', $this->stealth_disadvantage])
            ->andFilterWhere(['like', 'dex_mod', $this->dex_mod]);

        return $dataProvider;
    }
}
