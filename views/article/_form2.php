<?php

use yii\widgets\ActiveForm;
use \yii\helpers\Url;
use \yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Article */
?>

<div class="article-form">
    <div class="row">
        <p>Dieses Bild wird als Teaser-Bild in der Artikelübersicht verwendet.</p>
        <p>Es muss im Format 4:1 (Breite:Höhe).</p>
        <p>Ist das Bild zu hoch, wird der untere Teil abgeschnitten.</p>
        <p>Ist das Bild zu breit, wird die rechte Seite abgeschnitten.</p>
        <?php
            $form = ActiveForm::begin([
                'action' => Url::to(['article/createuploadimage']),
                'options' => [
                    'enctype' => 'multipart/form-data',
                ],
            ]);
        ?>
        
        <?= $form->field($model, 'articleId')->hiddenInput(['value' => $model->articleId])->label(false) ?>
        
        <?= $form->field($model, 'file')->fileInput()->label(false) ?>
        
        <?= Html::submitButton('Weiter', ['class' => 'btn btn-success']) ?>
        
        <?= Html::submitButton('Zurück', ['name' => 'cancel', 'class' => 'btn btn-primary']) ?>
        
        <?php ActiveForm::end(); ?>
    </div>
</div>