<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "class_skill_proficiency".
 *
 * @property int $id
 * @property int $skill_id
 * @property int $class_id

 *
 * @property _Class $class
 * @property Skill $skill
 */
class ClassSkillProficiency extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'class_skill_proficiency';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['skill_id', 'class_id'], 'integer'],
            [['class_id'], 'exist', 'skipOnError' => true, 'targetClass' => _Class::className(), 'targetAttribute' => ['class_id' => 'id']],
            [['skill_id'], 'exist', 'skipOnError' => true, 'targetClass' => Skill::className(), 'targetAttribute' => ['skill_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'skill_id' => Yii::t('app', 'Skill ID'),
            'class_id' => Yii::t('app', 'Class ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClass()
    {
        return $this->hasOne(_Class::className(), ['id' => 'class_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSkill()
    {
        return $this->hasOne(Skill::className(), ['id' => 'skill_id']);
    }
}
