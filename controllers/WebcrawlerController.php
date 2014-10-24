<?php

namespace app\controllers;

use app\models\Article;
use yii\data\ActiveDataProvider;
use \app\models\Webcrawler;
use \app\models\User;
use \app\commands\WebCrawlerCmdController;

class WebcrawlerController extends \yii\web\Controller {

    public function actionImport() {
        $webcrawlerCmd = new WebCrawlerCmdController('WebCrawlerCmd', null);
        $success = $webcrawlerCmd->actionImport();
        var_dump($success);
    }

    /*
     * Hier werden die Daten gesammelt.
     */

    public function actionConfirm() {
        $dataProvider = new ActiveDataProvider([
            'query' => Article::find()->where(['userId' => User::find()->where("username = 'SOLCITY_RSS_CRAWLER'")->one()->userId, 'released' => 0]),
        ]);
        
        return $this->render('confirm', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /*
     * Hier werden die Links angezeigt, f�r welche Daten gesammelt werden.
     */

    public function actionIndex() {
        $links = Webcrawler::find()->all();

        return $this->render('index', [
            'links' => $links,
        ]);
    }
    
    public function actionRelease($id) {
        if (Article::find()->where('articleId = :articleId', ['articleId' => $id])->one()->release()) {
            return $this->redirect(['confirm']);
        } else {
            die('asdf');
        }
    }
}
