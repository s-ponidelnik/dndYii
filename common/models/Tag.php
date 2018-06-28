<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tags".
 *
 * @property int $id
 * @property string $tag
 *
 * @property NoteTags[] $noteTags
 */
class Tag extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tags';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tag'], 'required'],
            [['tag'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'tag' => Yii::t('app', 'Tag'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNoteTags()
    {
        return $this->hasMany(NoteTag::className(), ['tag_id' => 'id']);
    }

    public static function getAllList()
    {
        $tagList = [];
        $tags = Tag::find()->select(['id', 'tag']);
        foreach ($tags->all() as $tag) {
            $tagList[$tag->id] = $tag->tag;
        }
        return $tagList;
    }
}
