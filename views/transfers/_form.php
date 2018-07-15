<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Transfers */
/* @var $form yii\widgets\ActiveForm */
$users = app\models\User::find()->column();

if (($key = array_search(Yii::$app->user->identity->username, $users)) !== false) {
    unset($users[$key]);
}
$users = array_combine($users, $users);
?>

<div class="transfers-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'to')->dropDownList($users) ?>
    <?= $form->field($model, 'amount')->textInput() ?>

    <?php
//    echo  $form->field($model, 'amount')->widget(\yii\widgets\MaskedInput::className(), [
//    'name' => 'masked-input',
//    'clientOptions' => [
//        'alias' => 'decimal',
//        'digits' => 2,
//        'digitsOptional' => TRUE,
//        'radixPoint' => '.',
//        'groupSeparator' => ' ',
//        'autoGroup' => TRUE,
//        'removeMaskOnSubmit' => TRUE,
//        ]
//]);
 
    ?>



    <div class="form-group">
        <?= Html::submitButton('Send', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
