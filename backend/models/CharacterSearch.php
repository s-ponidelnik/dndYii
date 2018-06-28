<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Character;

/**
 * CharacterSearch represents the model behind the search form of `common\models\Character`.
 */
class CharacterSearch extends Character
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'race_id', 'hp', 'exp'], 'integer'],
            [['icon_src'], 'string'],
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
        $query = Character::find();

        // add conditions that should always apply here
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);
        if (!Yii::$app->user->identity->isAdmin) {
            $query->andWhere(['player_id' => Yii::$app->user->id]);
        }
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'race_id' => $this->race_id,
            'hp' => $this->hp,
            'exp' => $this->exp,
            'icon_src' => $this->icon_src
        ]);

        return $dataProvider;
    }
}
