<?php

namespace app\models;

use \Yii;
use \yii\base\Exception;

/**
 * This is the model class for table "{{%image}}".
 *
 * @property integer $imageId
 * @property string $physicalPath
 * @property string $alternativeText
 * @property integer $articleId
 * @property integer $eventId
 *
 * @property Event $event
 * @property Article $article
 * @property User[] $users
 */
class Image extends \yii\db\ActiveRecord {
    public $file;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%image}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['physicalPath'], 'required'],
            [['physicalPath', 'alternativeText'], 'string'],
            [['articleId', 'eventId'], 'integer'],
            [['file'], 'file'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'imageId' => 'Image ID',
            'physicalPath' => 'Physical Path',
            'alternativeText' => 'Alternative Text',
            'articleId' => 'Article ID',
            'eventId' => 'Event ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvent() {
        return $this->hasOne(Event::className(), ['eventId' => 'eventId']);
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
    public function getUsers() {
        return $this->hasMany(User::className(), ['imageId' => 'imageId']);
    }
    
    public function crop($desiredAaspectRatio, $targetPath) {
        try {
            $originImage = imagecreatefromjpeg(Yii::$app->params['resources']['path']['temp-upload'] . $this->physicalPath);
            if(empty($originImage)){
                die("asd");
                
            }
            $originImageSize = getimagesize(Yii::$app->params['resources']['path']['temp-upload'] . $this->physicalPath);
            $originImageSizeX = $originImageSize[0];
            $originImageSizeY = $originImageSize[1];
            
            if ($originImageSizeX / $originImageSizeY != $desiredAaspectRatio) {
                $newImageSizeX = $originImageSizeX;
                $newImageSizeY = $originImageSizeY;
                if ($originImageSizeX / $originImageSizeY > $desiredAaspectRatio) {
                    $newImageSizeX = $originImageSizeY * $desiredAaspectRatio;
                } else {
                    $newImageSizeY = $originImageSizeX / $desiredAaspectRatio;
                }
                
                $newImage = imagecreatetruecolor($newImageSizeX, $newImageSizeY);
                imagecopy($newImage, $originImage, 0, 0, 0, 0, $originImageSizeX, $originImageSizeY);
                
                header('Content-Type: image/jpeg');
                $this->physicalPath = $targetPath . hash('sha256', time() . $this->physicalPath) . '.jpeg';
                imagejpeg($newImage, $this->physicalPath, 100);
                return $this->save();
            }
            return true;
        } catch (Exception $ex) {
            die("qasd");
            return false;
        }
    }
}
