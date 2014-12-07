<?php

use yii\helpers\Url;

/* @var $model app\models\Article */
?>

<div class="row">
        
<?php
    $articles = \app\models\Article::find()->where(['released' => '1'])->all();
    $items = array();
    $counter=0;
    if(count($articles) > 0):
    foreach ($articles as $article):
?>   
    <div class="col-lg-5 singleArticle">
        <div class="author">
            <a href="<?= Url::to(['user/view', 'id' => $article->userId]) ?>">
                <img src="<?= $article->user->getAvatarImage() ?>" alt="Autor" title="<?= $article->user->userName ?>">
            </a>
        </div>
        <div class="panel panel-default inArticle">
            <div class="panel-heading" >
                <img class="teaser-image" src="<?= $article->getTeaserImage() ?>" alt="Titelbild des Artikels" width="100%">
            </div>

            <div class="panel-body">
                <p class="meta"><?= Yii::$app->formatter->asDatetime($article->dateCreated, 'php:d.m.Y H:i') ?></p>
                <p class="title"><?= $article->title; ?></p>
                <p><?= $article->shortArticle; ?></p>
            </div>

            <div class="panel-footer">
                <?php if (!empty($article->originLink)): ?>
                <p class="readMore">
                    <?= $article->buildOriginLinkAsHtml('Zum Original-Artikel', ['target' => '_blank']); ?>
                    <i class="fa fa-chevron-right"></i>
                </p>
                <?php else: ?>
                <p class="readMore">
                    <?= $article->buildArticleDetailLinkAsHtml('Zum Artikel'); ?>
                    <i class="fa fa-chevron-right"></i>
                </p>
                <?php endif; ?>
             </div>
        </div>
    </div>

<?php
    $counter++;
    if($counter%2==0){
        echo "</div><div class='row'>";
    }
    endforeach;
    endif;
?>

</div>