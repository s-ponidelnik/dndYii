<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ArmorTypeArmorRel;

/**
 * ArmorTypeArmorRelSearch represents the model behind the search form of `common\models\ArmorTypeArmorRel`.
 */
class ArmorTypeArmorRelSearch extends ArmorTypeArmorRel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'armor_id', 'type_id'], 'integer'],
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
        $query = ArmorTypeArmorRel::find();

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
            'armor_id' => $this->armor_id,
            'type_id' => $this->type_id,
        ]);

        return $dataProvider;
    }
}
