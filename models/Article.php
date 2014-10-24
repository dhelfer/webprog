<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%article}}".
 *
 * @property integer $articleId
 * @property string $title
 * @property string $article
 * @property string $originLink
 * @property integer $userId
 * @property integer $subCategoryId
 *
 * @property Subcategory $subCategory
 * @property User $user
 * @property Comment[] $comments
 * @property Image[] $images
 */
class Article extends \yii\db\ActiveRecord {
    
    const ARTICLELEN = 180;
    
    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%article}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['title', 'article', 'originLink'], 'string'],
            [['userId', 'subCategoryId'], 'required'],
            [['userId', 'subCategoryId'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'articleId' => 'Article ID',
            'title' => 'Title',
            'article' => 'Article',
            'originLink' => 'Origin Link',
            'userId' => 'User ID',
            'subCategoryId' => 'Sub Category ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubCategory() {
        return $this->hasOne(Subcategory::className(), ['subCategoryId' => 'subCategoryId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser() {
        return $this->hasOne(User::className(), ['userId' => 'userId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments() {
        return $this->hasMany(Comment::className(), ['articleId' => 'articleId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImages() {
        return $this->hasMany(Image::className(), ['articleId' => 'articleId']);
    }
    
    public function getShortArticle(){
        $pos = strlen($this->article);
        if ($pos >= self::ARTICLELEN){
            $pos = strpos($this->article, " ", self::ARTICLELEN);
        }
        
        return substr($this->article, 0, $pos);
    }
    
    public function showReadMore(){
        if(strlen($this->article) > self::ARTICLELEN){
            return true;
        } else {
            return false;
        }
    }
}
