<?php

/* @var $this yii\web\View */
/* @var $user common\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['util/reset-password', 'token' => $user->password_reset_token]);
?>
Hello <?= $user->username ?>,

Use this code reset your password:

<?= $user->password_reset_token ?>
