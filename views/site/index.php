<?php
/* @var $this yii\web\View */
/* @var $articles array */

$this->title = 'SolCity';
?>
<div class="site-index">
    <div class="body-content">
        <?= $this->render('..\article\_multi', ['articles' => $articles]) ?>
    </div>
</div>
