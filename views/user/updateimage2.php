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
            <?php
                $form = ActiveForm::begin([
                    'action' => Url::to(['user/updateimageconfirm']),
                ]);
            ?>

            <?= $form->field($model, 'userId')->hiddenInput(['value' => $model->userId])->label(false) ?>

            <div class="header-image">
                <img src="<?= !empty($model->imageId) ? $model->image->physicalPath : Yii::$app->params['resources']['default']['user']['avatar'] ?>" alt="Avatar" title="Avatar" width="50%">
            </div>

            <?= Html::submitButton('Bestätigen', ['class' => 'btn btn-success']) ?>

            <?= Html::submitButton('Zurück', ['name' => 'cancel', 'class' => 'btn btn-primary']) ?>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
