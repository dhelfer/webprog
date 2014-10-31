<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%webcrawler_import_log}}".
 *
 * @property integer $webcrawlerImportLogId
 * @property integer $webcrawlerId
 * @property integer $articleId
 * @property string $executionTime
 * @property string $message
 * @property integer $runNumber 
 *
 * @property Article $article
 * @property Webcrawler $webcrawler
 */
class WebcrawlerImportLog extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%webcrawler_import_log}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['webcrawlerId', 'runNumber'], 'required'],
            [['webcrawlerId', 'articleId', 'runNumber'], 'integer'],
            [['executionTime'], 'safe'],
            [['message'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'webcrawlerImportLogId' => 'Webcrawler Import Log ID',
            'webcrawlerId' => 'Webcrawler ID',
            'articleId' => 'Article ID',
            'executionTime' => 'Execution Time',
            'message' => 'Message',
        ];
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
    public function getWebcrawler() {
        return $this->hasOne(Webcrawler::className(), ['webcrawlerId' => 'webcrawlerId']);
    }
    
    /**
     * Get colored thumbs-up or thumbs-down according to import state.
     * 
     * @return string
     */
    public function getState() {
        $class = '';
        if (empty($this->message)) {
            $class = 'up green';
        } elseif (empty($this->article)) {
            $class = 'down red';
        } else {
            $class = 'up orange';
        }
        
        return '<i class="fa fa-thumbs-' . $class . '"></i>';
    }
}
