<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\User;
use app\models\Forms;
/* @var $this yii\web\View */
/* @var $searchModel app\models\FormsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->registerCssFile("@web/css/test.css", [
    'depends' => [\yii\bootstrap\BootstrapAsset::className()]
]);

$this->title = 'Forms';
$this->params['breadcrumbs'][] = $this->title;
?>

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Tables</title>

    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
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

<div class="forms-index">

    <div class="container">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <!-- <?= Html::a('Create Forms', ['create'], ['class' => 'btn btn-success']) ?> -->
        <?= Html::a('New', ['status', 'status' => 'Pemeriksaan'], ['class' => 'btn btn-info']) ?>
        <?= Html::a('Ongoing', ['status', 'status' => 'Proses'], ['class' => 'btn btn-info']) ?>
        <?= Html::a('Finished', ['status', 'status' => 'Selesai'], ['class' => 'btn btn-info']) ?>
    </p>
    <br>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'caseid',
            [
                'label' => 'Nama',
                'attribute' => 'Nama',
                'value' => function($data){
                    $model = User::find()->select('username')->where(['email' => (string) $data->email])->asArray()->limit(1)->all();
                    if($model != NULL){
                        return $model[0]['username'];
                    }else{
                        return "None";
                    }
                    
                },
            ],
            'phonenum',
            'location',
            'description',
            [
                'label' => 'Tanggal',
                'attribute' => 'tanggalwaktu',
                'value' => function($data){
                    //return substr($data->tanggalwaktu, 0, -7);
                    return $data->tanggalwaktu;
                },
            ],            //'description',
            //'gambar',
            //'casedue',
            //'email:email',
            [
                'label' => 'Status',
                'attribute' => 'status',
                'value' => function($data){
                    //return substr($data->tanggalwaktu, 0, -7);
                    return $data->status;
                },
            ],  
            // 'status',
            'supervisor',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
</div>
