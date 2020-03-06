<?php

/* @var $this yii\web\View */
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use app\models\Forms;
use app\models\Images;

$dataProvider = new ActiveDataProvider([
        'query' => Forms::find(),
        'pagination' => [
            'pageSize' => 10,
        ],
        //'pagination' => false,
        'sort' =>[
            'attributes' => ['tanggalwaktu', 'location','description'],
            'defaultOrder' => ['tanggalwaktu' =>SORT_DESC, 'location' =>SORT_ASC,'description' =>SORT_DESC]
        ],
        //'sort' => false

]);

$this->title = 'My Yii Application';
?>
<div class="site-index">


    <div class="jumbotron">
        <h1>K3L</h1>

        <!-- <p class="lead">You have successfully created your Yii-powered application....</p> -->

        <p><a class="btn btn-lg btn-success" href="/k3lweb/web/index.php?r=site%2Fform">ISI FORM</a></p>
    </div>

    <div class="body-content">
        
        <?php

        echo GridView::widget([
            'dataProvider'=> $dataProvider,
            'emptyCell' => '-',
            'showHeader' => true,
            //'showFooter' => true,
            //'layout' => "\n{pager}\n{summary}\n{items}",
            //'showOnEmpty' =>true,
            'columns' => [
                            'tanggalwaktu',
                            // [
                            //     'attribute' => 'gambar',
                            //     'label' => 'Gambar',
                            //     'format' => 'html',
                            //     'value' => function($data){
                            //         return 'Gambar';
                            //     },
                            //     //'visible' => true,
                            //     'header' => 'Gambar',
                            //     //'footer' => 'Gambar'
                            // ],
                            [
                                'attribute' => 'gambar',
                                'label' => 'Gambar',
                                'format' => 'html',
                                // images.imageFiles
                                'value' => function($data){
                                    $imageLink = "";
                                    $images = Images::find()->where(['caseId' => (string) $data['caseid']])->All();
                                    foreach ($images as $img){
                                        $imageLink .= '<a href="'.Yii::$app->request->baseUrl.'/uploads/'.$img['imageFiles'].'">Link</a>';
                                    }
                                    return $imageLink;
                                    // return '<img src="'.Yii::$app->request->baseUrl.'/uploads/'.'images.imageFiles'.'">';
                                },
                                //'value' => 'images.imageFiles',
                                //'visible' => true,
                                'header' => 'Gambar',
                                //'footer' => 'Gambar'
                            ],
                            'location','description',
                            [
                                'attribute' => 'status',
                                'label' => 'Status',
                                'value' => function($data){
                                    if($data->status == 'Process'){
                                        return 'Process';
                                    }else{
                                        return 'Done';
                                    }
                                },
                                //'visible' => true,
                                'header' => 'Status',
                                //'footer' => 'Gambar'
                            ],
                            // [
                            //     'class' => 'yii\grid\ActionColumn',
                            //     'header' => 'Action',
                            //     'headerOptions' => ['width' => '80'],
                            //     'template' => '{view}{update}{delete}'
                            // ]
                        ],
        ]);


        ?>

        

        <!-- <div class="row">
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>
            </div>
        </div> -->

    </div>
</div>
