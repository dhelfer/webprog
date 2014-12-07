<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = 'Update Avatar';
?>
<div class="user-create">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="article-form">
        <div class="row">
            <p>Dieses Bild wird als Teaser-Bild in der Artikelübersicht verwendet.</p>
            <p>Es muss im Format 1:1 (Breite:Höhe).</p>
            <p>Ist das Bild zu hoch, wird der untere Teil abgeschnitten.</p>
            <p>Ist das Bild zu breit, wird die rechte Seite abgeschnitten.</p>
            <?php
                $form = ActiveForm::begin([
                    'action' => Url::to(['user/updateimage']),
                    'options' => [
                        'enctype' => 'multipart/form-data',
                    ],
                ]);
            ?>

            <?= $form->field($model, 'userId')->hiddenInput(['value' => $model->userId])->label(false) ?>

            <?= $form->field($model, 'file')->fileInput()->label(false) ?>

            <?= Html::submitButton('Weiter', ['class' => 'btn btn-success']) ?>

            <?= Html::submitButton('Zurück', ['name' => 'cancel', 'class' => 'btn btn-primary']) ?>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
