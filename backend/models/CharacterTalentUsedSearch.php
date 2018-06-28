<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\CharacterTalentUsed;

/**
 * CharacterTalentUsedSearch represents the model behind the search form of `common\models\CharacterTalentUsed`.
 */
class CharacterTalentUsedSearch extends CharacterTalentUsed
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'character_id', 'talent_id', 'used'], 'integer'],
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
        $query = CharacterTalentUsed::find();

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
            'talent_id' => $this->talent_id,
            'used' => $this->used,
        ]);

        return $dataProvider;
    }
}
