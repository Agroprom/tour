<?php

/* @var $this yii\web\View */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;


$this->title = 'Login';
?>
<div class="user-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
