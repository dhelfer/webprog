<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Article */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Articles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-view">
        <div class="row">
            <div class="col-lg">
                <div class="panel panel-default inArticle">
                    <div class="panel-heading inArticleHead" >
                        <h1><?= Html::encode($this->title) ?></h1>
                        <?php echo $model->subCategory->name ?>
                    </div>
                    
                    <div class="panel-body">
                        <?php echo $model->article ?>
                    </div>
                    
                    <div class="panel-footer inArticleFoot">
                        <a href='<?php echo $model->originLink ?>'><?php echo $model->originLink ?></a>
                     </div>

                </div>
            </div>
        </div>
</div>
