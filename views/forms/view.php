<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use app\models\User;
use app\models\Images;
use app\models\Notes;
/* @var $this yii\web\View */
/* @var $model app\models\Forms */
echo "<div class='container'>";

$this->registerCssFile("@web/css/test.css", [
    'depends' => [\yii\bootstrap\BootstrapAsset::className()]
]);

$this->title = $model->email;
$this->params['breadcrumbs'][] = ['label' => 'Forms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$this->registerJsFile(
    '@web/js/print.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);

 ?>



<div class="forms-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->caseid], ['class' => 'btn btn-info']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->caseid], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <p>

    <?php $form = ActiveForm::begin(); ?>

    <?php $form->action = "index.php?r=forms%2Fprint" ?>
    <input type="hidden" id="tableencoded" name="tableencoded" />
    <div class="form-group">
        <?= Html::submitButton('Print Forms', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    </p>
    <div class="table-contents">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
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
            //'name',
            'location',
            'tanggalwaktu',
            'description',
            [
                'attribute' => 'gambar',
                'label' => 'Gambar',
                'format' => 'html',
                'value' => function($data){
                    $imageLink = "";
                    $images = Images::find()->where(['caseId' => (string) $data->caseid])->asArray()->limit(3)->all();
                    $imgarr=null;
                    foreach ($images as $img){
                        $imgarr = $imgarr."<img src=".Yii::$app->request->baseUrl.'/uploads/'.$img['imageFiles']."
                        width='300px' height='auto'>";
                        
                    }
                    return  $imgarr;
                },
                'header' => 'Gambar',
            ],
            [
                'attribute' => 'Gambar Supervisor',
                'label' => 'Gambar Dari Supervisor',
                'format' => 'html',
                'value' => function($data){
                    //$imageLink = "";
                    $imagesSupervisor = Images::find()->where(['caseId' => (string) $data->caseid."s"])->asArray()->limit(3)->all();
                    if($imagesSupervisor==null){
                        return "On Progress";
                    }
                    $imgarr=null;
                    foreach ($imagesSupervisor as $imgSupervisor){
                        $imgarr = $imgarr."<img src=".Yii::$app->request->baseUrl.'/uploads/'.$imgSupervisor['imageFiles']."
                        width='300px' height='auto'>";
                        
                    }
                    return  $imgarr;
                },
                'header' => 'Gambar',
            ],
            'casedue',
            'email',
            'status',
            [
               'label' => 'Supervisor',
                'attribute' => 'supervisor',
                'value' => function($data){
                    $model = User::find()->select('username, status_detail,email')->where(['email' => (string) $data->supervisor])->asArray()->limit(1)->all();
                    if($model != NULL){
                        return $model[0]['username']." - ".$model[0]['status_detail']." (".$model[0]['email'].")";
                    }else{
                        return "None";
                    }
                    
                },
            ],
            [
                'label' => 'Notes from Admin',
                'value' => function ($model){
                    $notes = Notes::noteSearch($model->id,1);
                    return $notes['notes'];
                }
            ],
            [
                'label' => 'Notes from Supervisor',
                'value' => function ($model){
                    $notes = Notes::noteSearch($model->id,2);
                    return $notes['notes'];
                }
            ],
        ],
    ]) ?>


    </div>
</div>
</div>