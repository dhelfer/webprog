<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\SubCategory */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Sub Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sub-category-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <br>
    
    <div class="row">
        
        <?php
            $articles = \app\models\Article::find()->where(['subCategoryId' => $model->subCategoryId])->all();
            $items = array();
            $counter = 0;
            if(count($articles) > 0):
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
            endif;
        ?>
        
        </div>


</div>
