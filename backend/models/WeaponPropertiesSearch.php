<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\WeaponProperties;

/**
 * WeaponPropertiesSearch represents the model behind the search form of `common\models\WeaponProperties`.
 */
class WeaponPropertiesSearch extends WeaponProperties
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'property'], 'integer'],
            [['property_value'], 'safe'],
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
        $query = WeaponProperties::find();

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
            'property' => $this->property,
        ]);

        $query->andFilterWhere(['like', 'property_value', $this->property_value]);

        return $dataProvider;
    }
}
