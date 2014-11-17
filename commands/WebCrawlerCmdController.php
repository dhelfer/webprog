<?php

namespace app\commands;

use yii\console\Controller;
use \solcity\rssparser\Importer;

class WebCrawlerCmdController extends Controller {    
    public function actionImport() {
        echo Importer::widget([
            'options' => [
                'action' => 'import',
                'json' => true,
            ]
        ]);
        echo "\n";
        echo "action finished, check database log";
        echo "\n";
    }
}
