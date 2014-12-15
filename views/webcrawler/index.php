<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'RSS Feeds';
?>
<div class="webcrawler-index">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <?php $form = ActiveForm::begin(['action' => 'index.php?r=webcrawler/crawlall']); ?>
    
    <p>
        <?= Html::a('RSS Feed hinzufügen', ['create'], ['class' => 'btn btn-success', 'style' => 'color: #FFFFFF;']) ?>
        <?= Html::submitButton('Ausgewählte Feeds importieren', ['class' => 'btn btn-warning', 'style' => 'color: #FFFFFF;']) ?>
    </p>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'layout' => "{items}\n{pager}",
        'columns' => [
            [
                'class' => 'yii\grid\CheckboxColumn'
            ],
            'webcrawlerId',
            'link',
            [
                'label' => 'Kategorie',
                'value' => 'category.name',
            ],
            [
                'label' => 'Sub Kategorie',
                'value' => 'subCategory.name',
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
            ],
        ],
    ]); ?>
    
    <?php ActiveForm::end(); ?>

</div>

<?= Html::a('Starte Import', ['import'], ['class' => 'btn btn-danger', 'style' => 'color: #FFFFFF;']) ?>