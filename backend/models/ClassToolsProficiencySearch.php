<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ClassToolsProficiency;

/**
 * ClassToolsProficiencySearch represents the model behind the search form of `common\models\ClassToolsProficiency`.
 */
class ClassToolsProficiencySearch extends ClassToolsProficiency
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'tools_object_id', 'class_id','count'], 'integer'],
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
        $query = ClassToolsProficiency::find();

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
            'tools_object_id' => $this->tools_object_id,
            'count' => $this->count,
            'class_id' => $this->class_id,
        ]);

        return $dataProvider;
    }
}
