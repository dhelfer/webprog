<?php

namespace app\models;

use \yii\helpers\Html;

/**
 * executionDate
 * runNumber
 * countImported
 * countInfo
 * countError
 * 
 * @property date $executionDate
 */
class WebcrawlerImportLogGroup {
    public $linkToDetailLog;
    
    public function __construct() {
        $this->linkToDetailLog = Html::a(
            'Details',
            '#',
            [
                'onclick' => 'return loadImportStateDetail("'. \yii\helpers\Url::to('index.php?r=webcrawler/detaillog') . '", ' . $this->runNumber .');',
            ]);
    }
}