<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;
use \yii\helpers\Url;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model app\models\Article */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="article-form">
    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($model, 'title')->textInput() ?>
    
    <?= ''//$form->field($model, 'subCategoryId')->dropDownList(ArrayHelper::map(app\models\Subcategory::find()->all(), 'subCategoryId', 'name'), ['prompt' => 'a'])  ?>
    
    <div class="form-group field-article-categoryValue">
        <?php $primaryCategorieValueChoice = $model->findPrimaryCategorieValueChoice(); ?>
        <label class="control-label" for="article-categoryValue">Kategorie</label>
        <select id="article-categoryValue" class="form-control create-art-select-cat" name="Article[categoryValue]">
        <?php if (!isset($model->categoryValue)): ?>
            <option class="parent" value="">Wählen Sie eine Kategorie</option>
        <?php endif; ?>
        <?php $cats = app\models\Category::find()->all(); ?>
        <?php foreach ($cats as $cat): ?>
            <?php if (count($cat->subcategories) > 0): ?>
                <optgroup label="<?= $cat->name ?>" value="<?= 'Category' . $cat->categoryId ?>">
            <?php else: ?>
                <option class="parent hasNoChild" value="<?=  'Category' . $cat->categoryId ?>"
                    <?= $primaryCategorieValueChoice == 'Category' . $cat->categoryId ? 'selected' : '' ?>><?=$cat->name ?></option>
            <?php endif; ?>
            <?php foreach ($cat->subcategories as $subcat): ?>
                <option class="child" value="<?= 'SubCategory' . $subcat->subCategoryId ?>"
                        <?= $primaryCategorieValueChoice == 'SubCategory' . $subcat->subCategoryId ? 'selected' : '' ?>><?= $subcat->name ?></option>
            <?php endforeach; ?>
            <?php if (count($cat->subcategories) > 0): ?>
                </optgroup>
            <?php endif; ?>
        <?php endforeach; ?>
        </select>
    </div>
    
    <?= $form->field($model, 'article')->widget(CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'full'
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['name' => 'article_create', 'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::submitButton('Vorschau', ['name' => 'article_preview', 'class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
