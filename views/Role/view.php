<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
echo "<div class='container'>";
/* @var $this yii\web\View */
/* @var $model app\models\User */
$this->registerCssFile("@web/css/test.css", [
    'depends' => [\yii\bootstrap\BootstrapAsset::className()]
]);
//$this->title = $model->email;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'email' => $model->email], ['class' => 'btn btn-info']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'username',
            'email',
            'status',
            'status_detail'
        ],
    ]) ?>

</div>
</div>