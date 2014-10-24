<?php
/* @var $this yii\web\View */
$this->title = 'SolCity';
?>
<div class="site-index">

    <div class="body-content">
        
        <div class="row">
        
        <?php
            $articles = \app\models\Article::find()->all();
            $items = array();
            $counter = 0;
            foreach ($articles as $article):
        ?>   
            <div class=" col-lg-4" id="featArticle">
                <div class="panel panel-default inArticle">
                    <div class="panel-heading inArticleHead" >
                        <h2><?php echo $article->title; ?></h2>
                    </div>
                    
                    <div class="panel-body panel-body-extra">
                        <p><?php echo $article->shortArticle; ?></p>
                    </div>
                    
                    <div class="panel-footer panel-footer-extra inArticleFoot">
                    <?php if( $article->showReadMore() ): ?>
                        <p class="readMore"><a class="btn btn-default" href="<?php echo $_SERVER['PHP_SELF'] ?>?r=article/view&id=<?php echo $article->articleId ?>">Weiterlesen</a></p>
                    <?php endif; ?>
                     </div>
                     
                </div>
            </div>
            
            
        <?php
            $counter++;
            if ($counter%3==0){
                echo "</div><div class='row'>";
            }
            endforeach;
        ?>
        
        </div>

    </div>
    
</div>
