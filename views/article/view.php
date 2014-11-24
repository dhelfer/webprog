<?php

/* @var $this yii\web\View */
/* @var $model app\models\Article */
/* @var $newComment app\models\Comment */

$this->title = $model->title;
?>
<div class="article-view">
    <?= $this->render('_single', ['model' => $model]) ?>
    <?= $this->render('_comments', ['model' => $model, 'newComment' => (isset($newComment) ? $newComment : null)]) ?>
</div>
