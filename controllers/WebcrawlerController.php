<?php

namespace app\controllers;

use app\models\Article;
use yii\data\ActiveDataProvider;

class WebcrawlerController extends \yii\web\Controller {

    public function actionImport() {
        echo "asd";
    }

    /*
     * Hier werden die Daten gesammelt.
     */

    public function actionConfirm() {
        $dataProvider = new ActiveDataProvider([
            'query' => \app\models\Article::find()->where(['userId' => 1, 'released' => 0]),
        ]);

        return $this->render('confirm', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /*
     * Hier werden die Links angezeigt, f�r welche Daten gesammelt werden.
     */

    public function actionIndex() {
        $links = \app\models\Webcrawler::find()->all();

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
