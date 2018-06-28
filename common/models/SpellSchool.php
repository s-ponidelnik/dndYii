<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "spell_school".
 *
 * @property int $id
 * @property string $name
 *
 * @property Spell[] $spells
 */
class SpellSchool extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'spell_school';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSpells()
    {
        return $this->hasMany(Spell::className(), ['spell_school_id' => 'id']);
    }
    public static function getAllList(){
        $resArr = [];
        $spellSchools = SpellSchool::find()->select(['id','name'])->all();
        foreach ($spellSchools as $spellSchool){
            $resArr[$spellSchool->id] = $spellSchool->name;
        }
        return $resArr;
    }
}
