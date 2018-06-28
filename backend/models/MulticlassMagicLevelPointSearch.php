<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\MulticlassMagicLevelPoint;

/**
 * MulticlassMagicLevelPointSearch represents the model behind the search form of `common\models\MulticlassMagicLevelPoint`.
 */
class MulticlassMagicLevelPointSearch extends MulticlassMagicLevelPoint
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'spell_level', 'spell_point', 'level'], 'integer'],
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
        $query = MulticlassMagicLevelPoint::find();

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
            'spell_level' => $this->spell_level,
            'spell_point' => $this->spell_point,
            'level' => $this->level,
        ]);

        return $dataProvider;
    }
}
