<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'email')->textInput(['readonly'=> true,'maxlength' => true]) ?>

    <?= $form->field($model, 'username')->textInput(['readonly'=> true,'maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList(
            ['Admin' => 'Admin', 'Supervisor' => 'Supervisor','User' => 'User', 'Guest' => 'Guest']) ?>

    <?= $form->field($model, 'status_detail')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
