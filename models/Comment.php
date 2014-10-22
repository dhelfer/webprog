<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%comment}}".
 *
 * @property integer $commentId
 * @property string $comment
 * @property integer $userId
 * @property integer $articleId
 *
 * @property Article $article
 * @property User $user
 */
class Comment extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%comment}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['comment', 'userId', 'articleId'], 'required'],
            [['comment'], 'string'],
            [['userId', 'articleId'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'commentId' => 'Comment ID',
            'comment' => 'Comment',
            'userId' => 'User ID',
            'articleId' => 'Article ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticle() {
        return $this->hasOne(Article::className(), ['articleId' => 'articleId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser() {
        return $this->hasOne(User::className(), ['userId' => 'userId']);
    }

}
