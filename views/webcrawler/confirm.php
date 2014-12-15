<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Articles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-index">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <?php $form = ActiveForm::begin(['action' => 'index.php?r=webcrawler/confirmall']); ?>
    
    <?= Html::submitButton('Ausgewählte Artikel veröffentlichen', ['class' => 'btn btn-warning']) ?>
    
    <br><br>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'summary' => Yii::$app->params['text']['gridview']['summary'],
        'columns' => [
            [
                'class' => 'yii\grid\CheckboxColumn'
            ],
            'articleId',
            'title',
            'article',
            [
                'attribute' => 'releaseLink',
                'format' => 'raw',
                'label' => 'Veröffentlichen',
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {delete}',
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $model->originLink);
                    },
                    'delete' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', 'index.php?r=webcrawler/deletearticle&id=' . $key);
                    },
                ]
            ],
        ],
    ]); ?>
    
    <?php ActiveForm::end(); ?>

</div>
