<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Spell;

/**
 * SpellSearch represents the model behind the search form of `common\models\Spell`.
 */
class SpellSearch extends Spell
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'level', 'overlay_time', 'overlay_time_type', 'distance', 'duration_time', 'duration_time_type'], 'integer'],
            [['name', 'spell_property', 'components', 'description'], 'safe'],
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
        $query = Spell::find();

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
            'level' => $this->level,
            'overlay_time' => $this->overlay_time,
            'overlay_time_type' => $this->overlay_time_type,
            'distance' => $this->distance,
            'duration_time' => $this->duration_time,
            'duration_time_type' => $this->duration_time_type,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'spell_property', $this->spell_property])
            ->andFilterWhere(['like', 'components', $this->components])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
