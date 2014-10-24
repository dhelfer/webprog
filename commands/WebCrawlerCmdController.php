<?php

namespace app\commands;

use yii\console\Controller;

require_once('assets/rsslib/rsslib.php');

class WebCrawlerCmdController extends Controller {
    public function actionImport() {
        $rssFeed = RSS_Get_Custom('http://www.20min.ch/rss/rss.tmpl?type=channel&get=4');
        
        //var_dump($rssFeed);
        
        foreach ($rssFeed as $rssItem) {
            $article = new \app\models\Article(array(
                'title' => $rssItem['title'],
                'article' => $rssItem['description'],
                'originLink' => $rssItem['link'],
                'userId' => 1,
                'subCategoryId' => 1,
                'released' => 0
            ));
            if ($article->save()) {
                echo "saved: " . $article->articleId . "\n";
            }
        }
        
    }
}
