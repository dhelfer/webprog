<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%category}}".
 *
 * @property integer $categoryId
 * @property string $name
 * @property string $description
 *
 * @property Article[] $articles
 * @property Subcategory[] $subcategories
 * @property Webcrawler[] $webcrawlers
 */
class Category extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%category}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['description'], 'string'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'categoryId' => 'Category ID',
            'name' => 'Name',
            'description' => 'Description',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticles() {
        return $this->hasMany(Article::className(), ['categoryId' => 'categoryId']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubcategories() {
        return $this->hasMany(Subcategory::className(), ['categoryId' => 'categoryId']);
    }
    
    public function hasChildren(){
        return Subcategory::find()->where(["categoryId" => $this->categoryId])->count() > 0;       
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWebcrawlers() {
        return $this->hasMany(Webcrawler::className(), ['categoryId' => 'categoryId']);
    }
}
