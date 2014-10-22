<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%webcrawler}}".
 *
 * @property integer $webcrawlerId
 * @property string $link
 * @property integer $categoryId
 *
 * @property Category $category
 */
class Webcrawler extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%webcrawler}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['link', 'categoryId'], 'required'],
            [['link'], 'string'],
            [['categoryId'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'webcrawlerId' => 'Webcrawler ID',
            'link' => 'Link',
            'categoryId' => 'Category ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['categoryId' => 'categoryId']);
    }
}
