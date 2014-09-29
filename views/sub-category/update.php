<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SubCategory */

$this->title = 'Update Sub Category: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Sub Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->subCategoryId]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sub-category-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
