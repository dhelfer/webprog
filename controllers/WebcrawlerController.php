<?php

namespace app\controllers;

class WebcrawlerController extends \yii\web\Controller
{
    
    private function rssImport(){
        echo "asd";
    }
    /*
     * Hier werden die Daten gesammelt.
     */
    public function actionConfirm()
    {   $this->rssImport();
    }

    /*
     * Hier werden die Links angezeigt, für welche Daten gesammelt werden.
     */
    public function actionIndex()
    {
        $links = \app\models\Webcrawler::find()->all();
        
        return $this->render('index', [
            'links' => $links,
        ]);
    }

}
