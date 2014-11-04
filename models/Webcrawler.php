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
 *
 * @property Category $category
 * @property Subcategory $subCategory
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
            [['link'], 'string'],
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
}
