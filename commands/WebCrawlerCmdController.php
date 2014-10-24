<?php

namespace app\commands;

use yii\console\Controller;

require_once(__DIR__  . '/../assets/rsslib/rsslib.php');

class WebCrawlerCmdController extends Controller {
    public function actionImport() {
        $rssFeed = RSS_Get_Custom('http://www.20min.ch/rss/rss.tmpl?type=channel&get=4');
        
        $success = array();
        
        foreach ($rssFeed as $rssItem) {
            $article = new \app\models\Article(array(
                'title' => $rssItem['title'],
                'article' => $rssItem['description'],
                'originLink' => $rssItem['link'],
                'userId' => \app\models\User::find()->where("username = 'SOLCITY_RSS_CRAWLER'")->one()->userId,
                'categoryId' => null,
                'subCategoryId' => null,
                'released' => 0
            ));
            if ($article->save()) {
                $success[$article->articleId] = true;
            } else {
                $success[$article->articleId] = false;
            }
        }
    }
}
