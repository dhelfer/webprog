<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Webcrawler */

$this->title = 'Add RSS Feed';
?>
<div class="webcrawler-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
