<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Webcrawler */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="webcrawler-form">
    
    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($model, 'link')->textInput() ?>
    
    <?= $form->field($model, 'categoryId')->dropDownList(ArrayHelper::map(app\models\Category::find()->all(), 'categoryId', 'name'), ['prompt' => '- - Null - -'])  ?>
    
    <?= $form->field($model, 'subCategoryId')->dropDownList(ArrayHelper::map(app\models\Subcategory::find()->all(), 'subCategoryId', 'name'), ['prompt' => '- - Null - -']) ?>
    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <a href="index.php?r=webcrawler/index" class="btn btn-warning">Abbrechen</a>
    </div>
    
    <?php ActiveForm::end(); ?>
</div>
