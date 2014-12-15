<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Article */
/* @var $defineHeaderImage boolean */
/* @var $adjustHeaderImage boolean */

$this->title = 'Artikel erstellen';
?>
<div class="article-create">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <?php if (isset($defineHeaderImage) && $defineHeaderImage): ?>
        <?= $this->render('_form2', ['model' => $model]) ?>
    <?php elseif (isset($adjustHeaderImage) && $adjustHeaderImage): ?>
        <?= $this->render('_form3', ['model' => $model]) ?>
    <?php else: ?>
        <?= $this->render('_form1', ['model' => $model]) ?>
    <?php endif; ?>

</div>
