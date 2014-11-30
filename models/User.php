<?php

namespace app\models;

use \yii\db\Expression;

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
 * @property string $accessToken
 * @property string $salt
 * @property string $activationKey
 * @property integer $active
 * @property string $passwordResetKey
 *
 * @property Article[] $articles
 * @property Comment[] $comments
 * @property Event[] $events
 * @property Image $image
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface {

    public $authKey = 'asdf';
    public $password2;
    public $passwordResetKeyCheck;

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
            [['userName', 'password', 'password2', 'email'], 'required'],
            [['imageId'], 'integer'],
            [['userName'], 'string', 'max' => 100],
            [['password', 'password2'], 'string', 'max' => 128],
            [['firstName', 'lastName', 'email'], 'string', 'max' => 255],
            [['password2'], 'compare', 'compareAttribute' => 'password', 'operator' => '=='],
            [['userName'], 'unique'],
            [['email'], 'unique'],
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
            'accessToken' => 'Access Token',
            'salt' => 'Salt',
            'activationKey' => 'Activation Key',
            'active' => 'Active',
            'passwordResetKey' => 'Password Reset Key',
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
        return self::findByUsernameAndActive($username, 1);
    }

    /**
     * Validates password.
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password) {
        $hash = hash('sha512', $password . $this->salt);
        return $hash === $this->password;
    }
    
    public function getFullname() {
        return $this->firstName . ' ' . $this->lastName;
    }
    
    public function createKey() {
        return hash('sha512', uniqid(rand(1, getrandmax()), true));
    }
    
    public function saltPassword() {
        $this->salt = hash('sha512', uniqid(rand(1, getrandmax()), true));
        $this->password = hash('sha512', $this->password . $this->salt);
    }
    
    public function beforeSave($insert) {
        parent::beforeSave($insert);
        
        if ($insert) {
            $this->saltPassword();
            $this->activationKey = $this->createKey();
        }
        return !empty($this->salt) && strlen($this->password) == 128 && !empty($this->activationKey);
    }
    
    public static function findByUsernameAndActive($username, $active) {
        return self::find()->where(['userName' => $username, 'active' => $active])->one();
    }
    
    public function activate() {
        $this->active = 1;
        $this->activationKey = new Expression('null');
        return $this->save(false);
    }
    
    public function getAvatarImage() {
        if (!empty($this->image)) {
            return $this->image->physicalPath;
        } else {
            return \Yii::$app->params['resources']['default']['user']['avatar'];
        }
    }
}
