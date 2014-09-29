<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%image}}".
 *
 * @property integer $imageId
 * @property string $physicalPath
 * @property string $alternativeText
 * @property integer $articleId
 * @property integer $eventId
 *
 * @property Event $event
 * @property Article $article
 * @property User[] $users
 */
class Image extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%image}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['physicalPath'], 'required'],
            [['physicalPath', 'alternativeText'], 'string'],
            [['articleId', 'eventId'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'imageId' => 'Image ID',
            'physicalPath' => 'Physical Path',
            'alternativeText' => 'Alternative Text',
            'articleId' => 'Article ID',
            'eventId' => 'Event ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvent()
    {
        return $this->hasOne(Event::className(), ['eventId' => 'eventId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticle()
    {
        return $this->hasOne(Article::className(), ['articleId' => 'articleId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['imageId' => 'imageId']);
    }
}
