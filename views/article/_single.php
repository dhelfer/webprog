<?php

use yii\helpers\Html;
use \yii\helpers\Url;

/* @var $model app\models\Article */
?>

<div class="row">
    <div class="panel panel-default inArticle">
        <div class="panel-heading inArticleHead">
            <img class="teaser-image" src="<?= $model->getTeaserImage() ?>" alt="Titelbild des Artikels" width="100%">
        </div>
        <div class="panel-body">
            <h1><?= Html::encode($this->title) ?></h1>
            <p class="meta">
                <span style="padding-left: 10px;"><b><?= Html::a('asdf', Url::to(['user/view', 'id' => $model->userId])) ?></b></span>
                <span style="padding-left: 10px;"><i><?= Yii::$app->formatter->asDatetime($model->dateCreated, 'php:d.m.Y H:i') ?></i></span>
            </p>
            <?php echo $model->article ?>
        </div>
        <div class="panel-footer inArticleFoot">
            <a href='<?php echo $model->originLink ?>'><?php echo $model->originLink ?></a>
         </div>
    </div>
</div>