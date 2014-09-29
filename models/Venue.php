<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%venue}}".
 *
 * @property integer $venueId
 * @property integer $zipCode
 * @property string $city
 * @property string $address
 * @property string $geoTagLatitude
 * @property string $geoTagLongitude
 *
 * @property Event[] $events
 */
class Venue extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%venue}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['zipCode'], 'integer'],
            [['geoTagLatitude', 'geoTagLongitude'], 'number'],
            [['city', 'address'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'venueId' => 'Venue ID',
            'zipCode' => 'Zip Code',
            'city' => 'City',
            'address' => 'Address',
            'geoTagLatitude' => 'Geo Tag Latitude',
            'geoTagLongitude' => 'Geo Tag Longitude',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvents()
    {
        return $this->hasMany(Event::className(), ['venueId' => 'venueId']);
    }
}
