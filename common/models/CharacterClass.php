<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "character_class".
 *
 * @property int $id
 * @property int $character_id
 * @property int $class_id
 * @property int $level
 * @property int $base_class
 *
 * @property Character $character
 * @property array $classesIds
 * @property _Class $class
 */
class CharacterClass extends \yii\db\ActiveRecord
{

    /* get with all parents*/
    public function getClassesIds()
    {
        $all = [];
        $all[] = $this->class_id;
        $parent_id = $this->class->parent_id;
        while (!empty($parent_id) && !in_array($parent_id, $all)) {
            $all[] = $parent_id;
            $parent_id = _Class::find()->select(['parent_id'])->where(['id' => $parent_id])->scalar();
        }
        return $all;
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'character_class';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['character_id', 'class_id', 'level', 'base_class'], 'integer'],
            [['character_id'], 'exist', 'skipOnError' => true, 'targetClass' => Character::className(), 'targetAttribute' => ['character_id' => 'id']],
            [['class_id'], 'exist', 'skipOnError' => true, 'targetClass' => _Class::className(), 'targetAttribute' => ['class_id' => 'id']],
        ];
    }

    public function beforeSave($insert)
    {
        if (CharacterClass::find()->where(['character_id' => $this->character_id, 'base_class' => 1])->count() == 0) {
            $this->base_class = 1;
        } else {
            $this->base_class = 0;
        }
        return parent::beforeSave($insert);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'character_id' => Yii::t('app', 'Character'),
            'class_id' => Yii::t('app', 'Class'),
            'level' => Yii::t('app', 'Level'),
            'base_class' => Yii::t('app', 'base_class'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCharacter()
    {
        return $this->hasOne(Character::className(), ['id' => 'character_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClass()
    {
        return $this->hasOne(_Class::className(), ['id' => 'class_id']);
    }
}
