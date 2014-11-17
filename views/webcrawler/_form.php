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
    
    <!--<?= $form->field($model, 'link')->textInput() ?>-->
    <div class="form-group field-webcrawler-link required">
        <label class="control-label" for="webcrawler-link">Link</label>
        <div class="input-group">
            <input id="webcrawler-link" type="text" class="form-control" name="Webcrawler[link]" value="<?= $model->link ?>">
            <span class="input-group-btn">
                <button class="btn btn-default" type="button"
                        onclick="return loadFeedItemStructure('<?= \yii\helpers\Url::to('index.php?r=webcrawler/feeditemstructure') ?>', $('#webcrawler-link').val())">
                    <i class="fa fa-download fa-lg"></i>
                </button>
            </span>
        </div>
        <div class="help-block"></div>
    </div>
    
    <?= $form->field($model, 'categoryId')->dropDownList(ArrayHelper::map(app\models\Category::find()->all(), 'categoryId', 'name'), ['prompt' => '- - Null - -'])  ?>
    
    <?= $form->field($model, 'subCategoryId')->dropDownList(ArrayHelper::map(app\models\Subcategory::find()->all(), 'subCategoryId', 'name'), ['prompt' => '- - Null - -']) ?>
    
    <!--<?= $form->field($model, 'specialMapping')->textInput(['disabled' => true]) ?>-->
    <div class="form-group field-webcrawler-specialmapping">
        <label class="control-label" for="webcrawler-specialmapping">Special Mapping</label>
        <div class="input-group">
            <input id="webcrawler-specialmapping" type="text" class="form-control" name="Webcrawler[specialMapping]" readonly value="<?= $model->specialMapping ?>">
            <span class="input-group-btn">
                <button class="btn btn-default" type="button"
                        onclick="$('#webcrawler-specialmapping').val('')">
                    <i class="fa fa-trash fa-lg"></i>
                </button>
            </span>
        </div>
        <div class="help-block"></div>
    </div>
    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <a href="index.php?r=webcrawler/index" class="btn btn-warning">Abbrechen</a>
    </div>
    
    <?php ActiveForm::end(); ?>
</div>
<div id='webcrawler_feed_item_structure'></div>
