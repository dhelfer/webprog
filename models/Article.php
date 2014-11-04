<?php

namespace app\models;

use \yii\helpers\Html;

/**
 * This is the model class for table "{{%article}}".
 *
 * @property integer $articleId
 * @property string $title
 * @property string $article
 * @property string $originLink
 * @property integer $userId
 * @property integer $subCategoryId
 * @property integer $released
 * @property integer $categoryId
 *
 * @property Category $category
 * @property Subcategory $subCategory
 * @property User $user
 * @property Comment[] $comments
 * @property Image[] $images
 */
class Article extends \yii\db\ActiveRecord {
    
    const ARTICLELEN = 200;
    
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
            [['userId'], 'required'],
            [['userId', 'subCategoryId', 'released', 'categoryId'], 'integer']
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
            'released' => 'Released',
            'categoryId' => 'Category ID', 
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory() {
        return $this->hasOne(Category::className(), ['categoryId' => 'categoryId']);
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
    

    public function release() {
        $this->released = 1;
        return $this->save();
    }
    
    public function getReleaseLink() {
        return Html::a(
            '<i class="fa fa-check-circle fa-2x green"></i>', 'index.php?r=webcrawler/release&id=' . $this->articleId, ['class' => 'icon-animated']);
    }

    public function getShortArticle(){
        $pos = strlen($this->article);
        if ($pos >= self::ARTICLELEN){
            if(!empty( strpos($this->article, " ", self::ARTICLELEN))){
                $pos = strpos($this->article, " ", self::ARTICLELEN);
            }
        }
        
        return substr($this->article, 0, $pos);
    }
    
    public function showReadMore(){
        return strlen($this->article) > self::ARTICLELEN || !empty($this->originLink);
    }
    
    public function findDuplicateByOriginlink() {
        return Article::find()->where(['originLink' => $this->originLink])->one();
    }
    
    public function buildOriginLinkAsHtml($text, $options = []) {
        return Html::a($text, $this->originLink, $options);
    }
    
    public function buildArticleDetailLinkAsHtml($text, $options = []) {
        return Html::a($text, 'index.php?r=article/view&id=' . $this->articleId, $options);
    }
}
