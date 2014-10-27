<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'RSS Feeds';
?>
<div class="webcrawler-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Add RSS Feed', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'layout' => "{items}\n{pager}",
        'columns' => [
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

</div>

<a href='<?php echo $_SERVER["PHP_SELF"] ?>?r=webcrawler/import' class="btn btn-danger">Starte Import</a>

