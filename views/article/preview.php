<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Article */
/* @var $newComment app\models\Comment */

$this->title = $model->title;
?>
<div class="article-view">
    <div class="row">
        <?= Html::a('Zurück', Url::to(['article/create', 'id' => $model->articlePreviewId]), ['class' => 'btn btn-primary']) ?>
        <br><br>
        <div class="panel panel-default inArticle">
            <div class="panel-heading inArticleHead" >
                <h1><?= Html::encode($this->title) ?></h1>
            </div>
            <div class="panel-body">
                <?php echo $model->article ?>
            </div>
        </div>
    </div>
</div>
