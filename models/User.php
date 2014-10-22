<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property integer $userId
 * @property string $userName
 * @property string $password
 * @property string $firstName
 * @property string $lastName
 * @property string $email
 * @property integer $imageId
 *
 * @property Article[] $articles
 * @property Comment[] $comments
 * @property Event[] $events
 * @property Image $image
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface {

    public $authKey = 'asdf';

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['userName', 'password'], 'required'],
            [['imageId'], 'integer'],
            [['userName'], 'string', 'max' => 100],
            [['password'], 'string', 'max' => 64],
            [['firstName', 'lastName', 'email'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'userId' => 'User ID',
            'userName' => 'User Name',
            'password' => 'Password',
            'firstName' => 'First Name',
            'lastName' => 'Last Name',
            'email' => 'Email',
            'imageId' => 'Image ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticles() {
        return $this->hasMany(Article::className(), ['userId' => 'userId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments() {
        return $this->hasMany(Comment::className(), ['userId' => 'userId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvents() {
        return $this->hasMany(Event::className(), ['userId' => 'userId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImage() {
        return $this->hasOne(Image::className(), ['imageId' => 'imageId']);
    }

    public function getAuthKey() {
        return $this->authKey;
    }

    public function getId() {
        return $this->userId;
    }

    public function validateAuthKey($authKey) {
        return true;
    }

    public static function findIdentity($id) {
        return self::find()->where(['userId' => $id])->one();
    }

    public static function findIdentityByAccessToken($token, $type = null) {
        return self::find()->where(['accessToken' => $token])->one();
    }

    /**
     * Finds user by username.
     *
     * @param  string      $username
     * @return User|null
     */
    public static function findByUsername($username) {
        return self::find()->where(['userName' => $username])->one();
    }

    /**
     * Validates password.
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password) {
        return $this->password === md5($password);
    }

}
