<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%subcategory}}".
 *
 * @property integer $subCategoryId
 * @property string $name
 * @property string $description
 * @property integer $categoryId
 *
 * @property Article[] $articles
 * @property Event[] $events
 * @property Category $category
 */
class Subcategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%subcategory}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['categoryId'], 'required'],
            [['categoryId'], 'integer'],
            [['name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'subCategoryId' => 'Sub Category ID',
            'name' => 'Name',
            'description' => 'Description',
            'categoryId' => 'Category ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticles()
    {
        return $this->hasMany(Article::className(), ['subCategoryId' => 'subCategoryId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvents()
    {
        return $this->hasMany(Event::className(), ['subCategoryId' => 'subCategoryId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['categoryId' => 'categoryId']);
    }
}
