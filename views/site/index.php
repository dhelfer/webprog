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
                        <p class="readMore"><a class="btn btn-default" href="<?php echo $_SERVER['PHP_SELF'] ?>?r=article/view&id=<?php echo $article->articleId ?>">Weiterlesen</a></p>
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
