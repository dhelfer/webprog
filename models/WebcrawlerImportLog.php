<?php

namespace app\models;

use Yii;
use \PDO;

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
            'articleId' => 'Artikel-ID',
            'executionTime' => 'Ausführungszeit',
            'message' => 'Nachricht',
            'runNumber' => 'Import-Zähler',
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
    
    public static function findGroupedImportStates() {
        $query = '
            SELECT		DATE(LOG1.executionTime) AS executionDate,
                        LOG1.runNumber,
                        (
                            SELECT	count(LOG2.webcrawlerImportLogId)
                            FROM	sc_webcrawler_import_log LOG2
                            WHERE	LOG2.runNumber = LOG1.runNumber
                            AND		LOG2.message IS NULL
                        AND		LOG2.articleId IS NULL
                        ) AS countError,
                        (
                            SELECT	count(LOG2.webcrawlerImportLogId)
                            FROM	sc_webcrawler_import_log LOG2
                            WHERE	LOG2.runNumber = LOG1.runNumber
                            AND		LOG2.message IS NOT NULL
                        AND		LOG2.articleId IS NOT NULL
                        ) AS countInfo,
                        (
                            SELECT	count(LOG2.webcrawlerImportLogId)
                            FROM	sc_webcrawler_import_log LOG2
                            WHERE	LOG2.runNumber = LOG1.runNumber
                            AND		LOG2.message IS NULL
                        AND		LOG2.articleId IS NOT NULL
                        ) AS countImported
            FROM		sc_webcrawler_import_log LOG1
            GROUP BY	DATE(LOG1.executionTime), LOG1.runNumber
            ORDER BY    LOG1.runNumber DESC';
        
        return Yii::$app->db->createCommand()->setSql($query)->queryAll([PDO::FETCH_CLASS, 'app\models\WebcrawlerImportLogGroup', []]);
    }
}
