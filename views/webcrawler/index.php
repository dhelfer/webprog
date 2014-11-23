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
        <?= Html::a('Add RSS Feed', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::submitButton('Ausgewählte Feeds importieren', ['class' => 'btn btn-danger']) ?>
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

<a href='<?php echo $_SERVER["PHP_SELF"] ?>?r=webcrawler/import' class="btn btn-danger">Starte Import</a>
