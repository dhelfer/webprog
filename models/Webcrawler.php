<?php

namespace app\models;

use \yii\helpers\Html;

/**
 * This is the model class for table "{{%webcrawler}}".
 *
 * @property integer $webcrawlerId
 * @property string $link
 * @property integer $categoryId
 * @property integer $subCategoryId
 * @property string $specialMapping 
 *
 * @property Category $category
 * @property Subcategory $subCategory
 * @property WebcrawlerImportLog[] $webcrawlerImportLogs 
 */
class Webcrawler extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%webcrawler}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['link'], 'required'],
            [['link', 'specialMapping'], 'string'],
            [['categoryId', 'subCategoryId'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'webcrawlerId' => 'Webcrawler ID',
            'link' => 'Link',
            'categoryId' => 'Category ID',
            'subCategoryId' => 'Sub Category ID',
            'specialMapping' => 'Special Mapping',
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
    public function getWebcrawlerImportLogs() {
        return $this->hasMany(WebcrawlerImportLog::className(), ['webcrawlerId' => 'webcrawlerId']);
    }

}
