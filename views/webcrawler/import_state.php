<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* $var $state boolean */
/* @var $log yii\data\ActiveDataProvider */

$this->title = 'RSS Import Report';
?>
<div class="webcrawler-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= GridView::widget([
        'dataProvider' => $log,
        'layout' => "{items}\n{pager}",
        'columns' => [
            [
                'attribute' => 'state',
                'format' => 'raw',
            ],
            'runNumber',
            'webcrawlerId',
            'executionTime',
            'articleId',
            'message',
        ],
    ]); ?>

</div>

<a href='<?= $_SERVER["PHP_SELF"] ?>?r=webcrawler/confirm' class="btn btn-success">Artikel veröffentlichen</a>
