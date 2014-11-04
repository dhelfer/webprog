<?php
/* @var $this yii\web\View */
$this->title = 'SolCity';
?>
<div class="site-index">

    <div class="body-content">
        
        <div class="row">
        
        <?php
            $articles = \app\models\Article::find()->where(['released' => '1'])->all();
            $items = array();
            $counter=0;
            if(count($articles) > 0):
            foreach ($articles as $article):
        ?>   
            <div class=" col-lg-6" id="featArticle">
                <div class="panel panel-default inArticle">
                    <div class="panel-heading inArticleHead" >
                        <h3><?php echo $article->title; ?></h3>
                    </div>
                    
                    <div class="panel-body panel-body-extra">
                        <p><?php echo $article->shortArticle; ?></p>
                    </div>
                    
                    <div class="panel-footer panel-footer-extra inArticleFoot">
                    <?php if( $article->showReadMore() ): ?>
                        <?php if (!empty($article->originLink)): ?>
                        <p class="readMore">
                            <?= $article->buildOriginLinkAsHtml('Kompletten Artikel lesen', ['class' => 'btn btn-default', 'target' => '_blank']); ?>
                        </p>
                        <?php else: ?>
                        <p class="readMore">
                            <?= $article->buildArticleDetailLinkAsHtml('Weiterlesen', ['class' => 'btn btn-default']); ?>
                        </p>
                        <?php endif; ?>
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

    </div>
    
</div>
