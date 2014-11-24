<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \app\models\Comment;

/* @var $model app\models\Article */
?>
<div class="row">
    <div class="panel panel-default inArticle">
        <?php foreach ($model->comments as $comment): ?>
        <div>
            <div style="float: left; margin-right: 25px;">
                <p><?= $comment->user->fullname; ?></p>
            </div>
            <div style="float: left;">
                <p><?= $comment->comment; ?></p>
            </div>
            <div style="clear:left;"></div>
        </div>
        <hr>
        <?php endforeach; ?>

        <div class="comment-form">
            <?php
                if (empty($newComment)) {
                    $newComment = new Comment();
                }
                $form = ActiveForm::begin([
                    'action' => 'index.php?r=article/comment',
                    'fieldConfig' => [
                        'template' => "{input}\n<div>{error}</div>",
                    ],
                ]);
            ?>
            <?= $form->field($newComment, 'comment')->textarea(['rows' => 6]) ?>
            <?= $form->field($newComment, 'userId')->hiddenInput(['value' => Yii::$app->user->id]) ?>
            <?= $form->field($newComment, 'articleId')->hiddenInput(['value' => $model->articleId]) ?>
            <div class="form-group">
                <?= Html::submitButton('Kommentieren', ['class' => 'btn btn-primary']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
