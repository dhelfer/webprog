<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Webcrawler */

$this->title = 'Update RSS Feed: ' . ' ' . $model->webcrawlerId;
?>
<div class="webcrawler-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
