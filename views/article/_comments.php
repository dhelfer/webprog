<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \app\models\Comment;

/* @var $model app\models\Article */
?>
<div class="row">
    <div class="panel panel-default inArticle">
        <table class="comment-table">
        <?php foreach ($model->comments as $comment): ?>
        <tr>
            <td class="meta">
                <p><b><?= $comment->user->userName; ?></b></p>
                <p><?= $comment->dateCreatedFormatted ?></p>
            </td>
            <td>
                <p><?= nl2br($comment->comment) ?></p>
            </td>
        </tr>
        <?php endforeach; ?>
        </table>
        <div class="comment-form add-comment">
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
