<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Article */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="article-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($model, 'title')->textInput() ?>
    
    <?= $form->field($model, 'subCategoryId')->dropDownList(ArrayHelper::map(app\models\Subcategory::find()->all(), 'subCategoryId', 'name'))  ?>
    

    <?= $form->field($model, 'article')->widget(CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'basic'
    ]) ?>

    <script type="text/javascript">
        CKEDITOR.replace( 'editor1', {
            filebrowserUploadUrl: "upload.php"
        } );
       alert("asd");
    </script>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
