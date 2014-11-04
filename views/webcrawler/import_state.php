<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use app\models\WebcrawlerImportLog;
use yii\data\ArrayDataProvider;

/* @var $this yii\web\View */
/* $var $state boolean */
/* @var $log yii\data\ActiveDataProvider */

$this->title = 'RSS Import Report';
?>

<h1><?= Html::encode($this->title) ?></h1>
<div class="webcrawler-index">
    
    <?= GridView::widget([
        'dataProvider' => new ArrayDataProvider([
            'allModels' => (new ActiveDataProvider(['query' => WebcrawlerImportLog::findGroupedImportStates()]))->query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]),
        'layout' => "{summary}\n{items}\n{pager}",
        'summary' => Yii::$app->params['text']['gridview']['summary'],
        'columns' => [
            [
                'label' => '',
                'attribute' => 'linkToDetailLog',
                'format' => 'raw',
            ],
            'executionDate',
            'runNumber',
            [
                'attribute' => 'countImported',
                'header' => '<i class="fa fa-thumbs-up green"></i>',
            ],
            [
                'attribute' => 'countInfo',
                'header' => '<i class="fa fa-thumbs-up orange"></i>',
            ],
            [
                'attribute' => 'countError',
                'header' => '<i class="fa fa-thumbs-down red"></i>',
            ],
        ],
    ]); ?>
</div>
<div id='webcrawler_detail_log'></div>