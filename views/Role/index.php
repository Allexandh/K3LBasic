<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RoleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>



    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            //'username',
            // 'auth_key',
            // 'password_hash',
            // 'password_reset_token',
            'email:email',
            ['attribute' => 'status',
             'label' => 'status',
            
            'value' => function($data){
                if($data->status == '7')
                    return 'Admin';
                else if($data->status == '8')
                    return 'User';
                else if($data->status == '9')
                    return 'Mahasiswa';
                else if($data->status == '10')
                    return 'Belom Aktif';
                else if($data->status == '11')
                    return '-';
                else
                    return 'NON';
            },
            //'visible' => true,
            'header' => 'Gambar',
            //'footer' => 'Gambar'
            ],
            //'created_at',
            //'updated_at',
            //'verification_token',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
