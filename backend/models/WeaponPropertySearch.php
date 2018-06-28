<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\WeaponProperty;

/**
 * WeaponPropertySearch represents the model behind the search form of `common\models\WeaponProperty`.
 */
class WeaponPropertySearch extends WeaponProperty
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'item_id'], 'integer'],
            [['damage_dice', 'two_hand_damage_dice'], 'safe'],
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
        $query = WeaponProperty::find();

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
        ]);

        $query->andFilterWhere(['like', 'damage_dice', $this->damage_dice])
            ->andFilterWhere(['like', 'two_hand_damage_dice', $this->two_hand_damage_dice]);

        return $dataProvider;
    }
}
