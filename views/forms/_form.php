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

<?php
    //var_dump($notes);

?>

    <?= $form->field($model, 'email')->textInput(['readonly'=> true,'maxlength' => true]) ?>

    <?= $form->field($model, 'phonenum')->textInput(['readonly'=> true,'maxlength' => true]) ?>

    <?= $form->field($model, 'location')->textInput(['readonly'=> true,'maxlength' => true]) ?>

    <?= $form->field($model, 'tanggalwaktu')->textInput(['readonly'=> true,'maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['readonly'=> true,'maxlength' => true]) ?>

    <?= $form->field($model, 'casedue')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'status')->dropDownList(
                ['Pemeriksaan' => 'Pemeriksaan', 'Proses' => 'Proses', 'Selesai' => 'Selesai', 'Batal' => 'Batal']);
    ?>

    <?php 
        echo $form->field($model, 'supervisor')->dropDownList(
        $user,
        ['prompt'=>'Select...']
        );
    ?>

    <?php
        foreach ($notes as $index => $note) {
            if(Yii::$app->user->identity->status == "Admin"){
                if($note->source == 1){
                    echo $form->field($note, "[$index]notes")->label("Notes From Admin");
                }else{
                    echo $form->field($note, "[$index]notes")->label("Notes From Supervisor")->textInput(['readonly'=> true]);
                }
            }else{
                if($note->source == 1){
                    echo $form->field($note, "[$index]notes")->label("Notes From Admin")->textInput(['readonly'=> true]);
                }else{
                    echo $form->field($note, "[$index]notes")->label("Notes From Supervisor");
                }
            }
        }
    ?>




    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
