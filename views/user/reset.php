<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\User;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
/* @var $passwordResetKey yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php if (isset($passwordResetKey) && isset($model) && $model->passwordResetKey === $passwordResetKey): ?>
        
        <?= $form->field($model, 'userId')->hiddenInput(['value' => $model->userId]) ?>
    
        <?= $form->field($model, 'passwordResetKeyCheck')->hiddenInput(['value' => $passwordResetKey]) ?>
    
        <?= $form->field($model, 'password')->passwordInput(['maxlength' => 128]) ?>
        
        <?= $form->field($model, 'password2')->passwordInput(['maxlength' => 128]) ?>
        
        <div class="form-group">
            <?= Html::submitButton('Passwort zurücksetzen', ['class' => 'btn btn-primary']) ?>
        </div>
    
    <?php else: ?>
        
        <?php $model = new User(); ?>
    
        <?= $form->field($model, 'userName')->textInput(['maxlength' => 100]) ?>
    
        <div class="form-group">
            <?= Html::submitButton('Senden Sie mir einen Reset-Link', ['class' => 'btn btn-primary']) ?>
        </div>
    
    <?php endif; ?>
    
    <?php ActiveForm::end(); ?>

</div>
