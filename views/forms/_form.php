<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model app\models\Forms */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="forms-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'email')->textInput(['readonly'=> true,'maxlength' => true]) ?>

    <?= $form->field($model, 'phonenum')->textInput(['readonly'=> true,'maxlength' => true]) ?>

    <?= $form->field($model, 'location')->textInput(['readonly'=> true,'maxlength' => true]) ?>

    <?= $form->field($model, 'tanggalwaktu')->textInput(['readonly'=> true,'maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['readonly'=> true,'maxlength' => true]) ?>

    <?= $form->field($model, 'casedue')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList(
            ['Pemeriksaan' => 'Pemeriksaan', 'Proses' => 'Proses', 'Selesai' => 'Selesai', 'Batal' => 'Batal']) ?>

    <?php 
        echo $form->field($model, 'supervisor')->dropDownList(
        $user,
        ['prompt'=>'Select...']
        );
    ?>




    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
