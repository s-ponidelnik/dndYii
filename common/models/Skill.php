<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "skill".
 *
 * @property int $id
 * @property string $name
 * @property string $_name
 * @property int $ability_id
 * @property string $desc
 *
 * @property ClassSkillProficiency[] $classSkillProficiencies
 * @property Ability $ability

 */
class Skill extends \yii\db\ActiveRecord
{
    public $_name;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'skill';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ability_id'], 'integer'],
            [['name','desc'], 'string'],
            [['ability_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ability::className(), 'targetAttribute' => ['ability_id' => 'id']],
            [['ability_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ability::className(), 'targetAttribute' => ['ability_id' => 'id']],
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
            'ability_id' => Yii::t('app', 'Ability ID'),
            'desc' => Yii::t('app', 'Desc'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClassSkillModifiers()
    {
        return $this->hasMany(ClassSkillModifier::className(), ['skill_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClassSkillProficiencies()
    {
        return $this->hasMany(ClassSkillProficiency::className(), ['skill_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAbility()
    {
        return $this->hasOne(Ability::className(), ['id' => 'ability_id']);
    }

    /**
     * @inheritdoc
     */
    public function afterFind()
    {
        $this->_name = Yii::t('app/skill', $this->name);
        parent::afterFind();
    }

    public static function getAllList(){
        return \yii\helpers\ArrayHelper::map(
            \common\models\Skill::find()
                ->select(['id', 'name'])
                ->asArray()
                ->all(),
            'id',
            'name'
        );
    }
}
