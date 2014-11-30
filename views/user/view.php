<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Article;
use \yii\grid\GridView;
use yii\data\ActiveDataProvider;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = $model->userName;
?>
<div class="user-view">
    <h1>
        <?= Html::encode($this->title) ?>
    </h1>
    
    <div class="row">
        <div class="col-md-4">
            <?= Html::img($model->getAvatarImage(), ['width' => '300px']) ?>
        </div>
        <div class="col-md-8">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'userName',
                    'fullName',
                ],
            ]) ?>
            <?php if (Yii::$app->user->id === $model->userId): ?>
            <?= Html::a('Bearbeiten <i class="fa fa-gear fa-spin"></i>', ['update', 'id' => $model->userId], ['class' => 'btn btn-primary']) ?>
            <?php endif; ?>
        </div>
    </div>
    <br><br>
    <div class="row">
        <div class="col-md-12">
        <?= GridView::widget([
            'dataProvider' => $dataProvider = new ActiveDataProvider(['query' => Article::find()->where(['userId' => $model->userId, 'released' => 1])]),
            'summary' => Yii::$app->params['text']['gridview']['summary'],
            'columns' => [
                'title',
                [
                    'header' => '',
                    'attribute' => 'viewDetailLink',
                    'format' => 'raw',
                ],
                
            ],
        ]); ?>
        </div>
    </div>
</div>
