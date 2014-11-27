<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $activationMailSent boolean */
/* @var $activationDone boolean */
/* @var $user string */
?>
<div class="user-view">
    <?php if (isset($activationMailSent)): ?>
        <?php if ($activationMailSent === true): ?>
            <h1>Registrierung erfolgreich</h1>
            <p>Eine Email mit dem Aktivierungscode ist bereits auf dem Weg zu Ihnen.</p>
            <?=Html::img('images/mail_sending.gif') ?>
        <?php else: ?>
            <h1>Registrierung fehlgeschlagen</h1>
            <div class="alert alert-danger" role="alert">
                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                <span class="sr-only">Error:</span>
                Die Email mit dem Aktivierungscode konnte nicht gesendet werden.
            </div>
        <?php endif; ?>
    <?php endif; ?>
    <?php if (isset($activationDone)): ?>
        <?php if ($activationDone === true): ?>
            <h1>Aktivierung erfolgreich</h1>
            <?= Html::a('Login', 'index.php?r=site/login' . (isset($user) ? '&user=' . $user : '')) ?>
        <?php else: ?>
            <h1>Aktivierung fehlgeschlagen</h1>
            <div class="alert alert-danger" role="alert">
                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                <span class="sr-only">Error:</span>
                Der Aktivierungscode ist falsch oder abgelaufen.
            </div>
        <?php endif; ?>
    <?php endif; ?>
</div>
