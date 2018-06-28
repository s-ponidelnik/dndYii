<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "notes".
 *
 * @property int $id
 * @property string $name
 * @property string $note
 * @property int $map_id
 * @property [] $tagsList
 *
 * @property Map $map
 */
class Note extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'notes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'note'], 'required'],
            [['note'], 'string'],
            [['map_id', 'parent_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['map_id'], 'exist', 'skipOnError' => true, 'targetClass' => Map::className(), 'targetAttribute' => ['map_id' => 'id']],
            [['parent_id'], 'exist', 'skipOnError' => true, 'targetClass' => Note::className(), 'targetAttribute' => ['parent_id' => 'id']],
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
            'note' => Yii::t('app', 'Note'),
            'map_id' => Yii::t('app', 'Map'),
            'parent_id' => Yii::t('app', 'Parent'),
            'tags' => Yii::t('app', 'Tags'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMap()
    {
        return $this->hasOne(Map::className(), ['id' => 'map_id']);
    }

    public function getNoteTags()
    {
        return $this->hasMany(NoteTag::className(), ['note_id' => 'id']);
    }

    public function getTags()
    {
        return $this->getNoteTags()->with('tag');
    }

    public function getTagsList()
    {
        $tagList = [];
        foreach ($this->tags as $tag) {
            $tagList[$tag->tag->id] = $tag->tag->tag;
        }
        return $tagList;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(Note::className(), ['id' => 'parent_id']);
    }

    public static function getAllList($forSelect = false)
    {
        if ($forSelect)
            $noteList = [null => '-'];
        else
            $noteList = [];
        $notes = Note::find()->select(['id', 'name']);
        /** @var Note $note */
        foreach ($notes->all() as $note) {
            $noteList[$note->id] = $note->name;
        }
        return $noteList;
    }
}
