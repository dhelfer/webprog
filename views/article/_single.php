<?php

use yii\helpers\Html;

/* @var $model app\models\Article */
?>

<div class="row">
    <div class="panel panel-default inArticle">
        <div class="panel-heading inArticleHead" >
            <h1><?= Html::encode($this->title) ?></h1>
            <?php echo $model->categoryOrSubCategory->name ?>
        </div>
        <div class="panel-body">
            <?php echo $model->article ?>
        </div>
        <div class="panel-footer inArticleFoot">
            <a href='<?php echo $model->originLink ?>'><?php echo $model->originLink ?></a>
         </div>
    </div>
</div>