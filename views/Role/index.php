<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RoleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
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
    <link href="css/theme.css" rel="stylesheet" media="all">

</head>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>



    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'username',
            // 'auth_key',
            // 'password_hash',
            // 'password_reset_token',
            'email',
            ['attribute' => 'status',
             'label' => 'status',
            
            // 'value' => function($data){
            //     if($data->status == '7')
            //         return 'Admin';
            //     else if($data->status == '8')
            //         return 'User';
            //     else if($data->status == '9')
            //         return 'Mahasiswa';
            //     else if($data->status == '10')
            //         return 'Belom Aktif';
            //     else if($data->status == '11')
            //         return '-';
            //     else
            //         return 'NON';
            // },
            //'visible' => true,
            'header' => 'Roles',
            //'footer' => 'Gambar'
            ],
            'status_detail',
            //'created_at',
            //'updated_at',
            //'verification_token',

            [
              'class' => 'yii\grid\ActionColumn',
              'header' => 'Actions',
              //'headerOptions' => ['style' => 'color:#337ab7'],
              'template' => '{view}{update}',
              'buttons' => [
                'view' => function ($url, $model) {
                    return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
                                'title' => Yii::t('app', 'View'),
                    ]);
                },

                'update' => function ($url, $model) {
                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                                'title' => Yii::t('app', 'Update'),
                    ]);
                },
                // 'delete' => function ($url, $model) {
                //     return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                //                 'title' => Yii::t('app', 'Delete'),
                //     ]);
                // }

              ],
              'urlCreator' => function ($action, $model, $key, $index) {
                if ($action === 'view') {
                    $url ='index.php?r=role/view&email='.$model->email;
                    return $url;
                }

                if ($action === 'update') {
                    $url ='index.php?r=role/update&email='.$model->email;
                    return $url;
                }
                // if ($action === 'delete') {
                //     $url ='index.php?r=role/delete&id='.$model->id;
                //     return $url;
                // }

              }
          ],
        ],
    ]); ?>


</div>
