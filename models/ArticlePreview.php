<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%article_preview}}".
 *
 * @property integer $articlePreviewId
 * @property string $title
 * @property string $article
 * @property integer $userId
 * @property string $dateCreated
 *
 * @property User $user
 */
class ArticlePreview extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%article_preview}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['title', 'article'], 'string'],
            [['userId', 'title', 'article'], 'required'],
            [['userId'], 'integer'],
            [['dateCreated'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'articlePreviewId' => 'Article Preview ID',
            'title' => 'Title',
            'article' => 'Article',
            'userId' => 'User ID',
            'dateCreated' => 'Date Created',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser() {
        return $this->hasOne(User::className(), ['userId' => 'userId']);
    }

}
