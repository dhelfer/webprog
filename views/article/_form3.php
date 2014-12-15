<?php

use yii\widgets\ActiveForm;
use \yii\helpers\Url;
use \yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Article */
?>

<div class="article-form">
    <div class="row">
        <?php
            $form = ActiveForm::begin([
                'action' => Url::to(['article/createadjustimage']),
            ]);
        ?>
        
        <?= $form->field($model, 'articleId')->hiddenInput(['value' => $model->articleId])->label(false) ?>
        
        <div class="header-image">
            <img src="<?= !empty($model->headerImage) ? $model->headerImage->physicalPath : Yii::$app->params['resources']['default']['article']['teaser_image'] ?>" alt="Titelbild" title="Titelbild" width="100%">
        </div>
        
        <br><br>
        
        <?= Html::submitButton('Veröffentlichen', ['class' => 'btn btn-success']) ?>
        
        <?= Html::submitButton('Zurück', ['name' => 'cancel', 'class' => 'btn btn-primary']) ?>
        
        <?php ActiveForm::end(); ?>
    </div>
</div>