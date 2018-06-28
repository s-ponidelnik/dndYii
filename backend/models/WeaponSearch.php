<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Weapon;

/**
 * WeaponSearch represents the model behind the search form of `common\models\Weapon`.
 */
class WeaponSearch extends Weapon
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'currency_type_id'], 'integer'],
            [['name', 'damage_dice', 'damage_type'], 'safe'],
            [['cost', 'weight'], 'number'],
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
        $query = Weapon::find();

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
            'cost' => $this->cost,
            'currency_type_id' => $this->currency_type_id,
            'weight' => $this->weight,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'damage_dice', $this->damage_dice])
            ->andFilterWhere(['like', 'damage_type', $this->damage_type]);

        return $dataProvider;
    }
}
