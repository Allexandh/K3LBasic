<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

//$this->title = 'Contact';

$this->registerCssFile("@web/css/test.css", [
    'depends' => [\yii\bootstrap\BootstrapAsset::className()]
]);

echo "<div class='container'>";

$this->title = 'Isi Form';
?>
<div class="site-form">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-lg-5">
            
        </div>
    </div>

</div>

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Forms</title>

    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <!-- <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all"> -->

    <!-- Vendor CSS-->
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <!-- <link href="css/theme.css" rel="stylesheet" media="all"> -->

</head>
<body>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
            </div>
            <div>
                <br>
                
            </div>
            <div class="card-body card-block">
                <?php $form = ActiveForm::begin(['id' => 'form-form'],['options' => ['enctype' => 'multipart/form-data']]); ?>



                <div class="row form-group">

                    <div class="col-12 col-md-12">
                        <?= $form->field($model, 'phonenum')->textinput()->input('phonenum',['placeholder' => "08123456789"]) ?>

                    </div>
                </div>
                <div class="row form-group">

                    <div class="col-12 col-sm-12">
                        <?= $form->field($model, 'location')->textinput()->input('phonenum',['placeholder' => "Gedung A, Lantai 3 Ruangan 303"]) ?>

                    </div>
                </div>

                <div class="row form-group">

                    <div class="col-12 col-sm-12">
                        <?= $form->field($model, 'description')->textarea(['rows' => 6])->textinput()->input('phonenum',['placeholder' => "Lantai Retak"]) ?>       

                    </div>
                </div>
               
                <div class="row form-group">
                    <div class="col-12 col-md-9">
                        <?= $form->field($images, 'imageFiles[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="form-group">
                    <?= Html::submitButton('Submit', ['class' => 'btn btn-success', 'name' => 'contact-button']) ?>
                </div>
            </div>
            
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
</body>



