<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%event}}".
 *
 * @property integer $eventId
 * @property string $name
 * @property string $description
 * @property integer $userId
 * @property integer $subCategoryId
 * @property integer $venueId
 *
 * @property Subcategory $subCategory
 * @property User $user
 * @property Venue $venue
 * @property Image[] $images
 */
class Event extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%event}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'userId', 'subCategoryId', 'venueId'], 'required'],
            [['name', 'description'], 'string'],
            [['userId', 'subCategoryId', 'venueId'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'eventId' => 'Event ID',
            'name' => 'Name',
            'description' => 'Description',
            'userId' => 'User ID',
            'subCategoryId' => 'Sub Category ID',
            'venueId' => 'Venue ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubCategory()
    {
        return $this->hasOne(Subcategory::className(), ['subCategoryId' => 'subCategoryId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['userId' => 'userId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVenue()
    {
        return $this->hasOne(Venue::className(), ['venueId' => 'venueId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImages()
    {
        return $this->hasMany(Image::className(), ['eventId' => 'eventId']);
    }
}
