<?php

/* @var $this yii\web\View */
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use app\models\Forms;
use app\models\Images;
use app\models\User;

$this->registerCssFile("@web/css/test.css", [
    'depends' => [\yii\bootstrap\BootstrapAsset::className()]
]);

$dataProvider = new ActiveDataProvider([
        'query' => Forms::find(),
        'pagination' => [
            'pageSize' => 5,
        ],
        //'pagination' => false,
        'sort' =>[
            'attributes' => ['tanggalwaktu', 'location','description'],
            'defaultOrder' => ['tanggalwaktu' =>SORT_DESC, 'location' =>SORT_ASC,'description' =>SORT_DESC]
        ],
        //'sort' => false

]);


$datauser = new ActiveDataProvider([
		'query' => User::find()
]);

$this->title = 'My Yii Application';
?>

	<div>
		<div class="row">
			<div>
	        	<div id="myCarousel" class="carousel slide" data-ride="carousel">
					<ol class="carousel-indicators">
					    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
					    <li data-target="#myCarousel" data-slide-to="1"></li>
				    </ol>

				  	<div class="carousel-inner">
				    	<div class="item active">
			      			<img src="images/kacablurfixfix.png" alt="Los Angeles">
			    		</div>
				    	<div class="item">
				      		<img src="images/orangblurfixfix.png" alt="Los Angeles">
				    	</div>
			  		</div>

			  		<div class="main-text hidden-xs">
	                	<div class="col-md-12 text-center">
	                		<br><br><br><br>
	                	
	                		<img src="images/logopng.png" width="50%" height="50%">
	                    <!-- <h1>
	                        BeSave</h1> -->
		                    <div class="hometext">
		                        Web aplikasi K3L untuk UMN
		                    </div>
	                    	<p><a class="btn btn-lg btn-success" href="index.php?r=site%2Fform">ISI FORM</a></p>
	                	</div>
	            	</div>
				</div>
	        </div>
	    </div>
	</div>
	<div id="push">
	</div>


        <!-- PAGE CONTENT-->
        <div class="page-content--bgf7">
            
		<div class="page-content--bge5">

				<!-- <div class="jumbotron"> -->
					<!-- <h1>K3L</h1> -->
					<!-- <img src="images/besafe.jpg" width="50%" height="50%">
					 -->
					<!-- <p class="lead">You have successfully created your Yii-powered application....</p> -->
<!-- 
					<p><a class="btn btn-lg btn-success" href="index.php?r=site%2Fform">ISI FORM</a></p>
				</div>
 -->
				<div class="body-content">

					<section class="statistic statistic2">
							<div class="container">
								<div class="row">
									<div class="col-md-6 col-lg-3">
									</div>
									<div class="col-md-6 col-lg-3">
										<div class="statistic__item statistic__item--orange">
											<h2 class="number"><?php
											echo $datauser->getTotalCount();
										?></h2>
											<span class="desc">total user</span>
											<div class="icon">
												<i class="zmdi zmdi-account-o"></i>
											</div>
										</div>
									</div>
									<!-- <div class="col-md-6 col-lg-3">
										<div class="statistic__item statistic__item--green">
											<h2 class="number">388,688</h2>
											<span class="desc">completed</span>
											<div class="icon">
												<i class="zmdi zmdi-assignment-check"></i>
											</div>
										</div>
									</div>
									<div class="col-md-6 col-lg-3">
										<div class="statistic__item statistic__item--red">
											<h2 class="number">1,086</h2>
											<span class="desc">report this week</span>
											<div class="icon">
												<i class="zmdi zmdi-calendar-note"></i>
											</div>
										</div>
									</div> -->
									<div class="col-md-6 col-lg-3">
										<div class="statistic__item statistic__item--blue">
											<h2 class="number"><?php
											echo $dataProvider->getTotalCount();
										?></h2>
											<span class="desc">total report</span>
											<div class="icon">
												<i class="zmdi zmdi-collection-text"></i>
											</div>
										</div>
									</div>
								</div>
							</div>
						</section>
					

					<div class="container">
					<?php

					echo GridView::widget([
						'dataProvider'=> $dataProvider,
						'emptyCell' => '-',
						'showHeader' => true,
						'options' => [ 'style' => 'height:100%;' ],
						//'showFooter' => true,
						//'layout' => "\n{pager}\n{summary}\n{items}",
						//'showOnEmpty' =>true,
						'columns' => [
									   // 'tanggalwaktu',
										[
											'label' => 'Tanggal',
											'attribute' => 'tanggalwaktu',
											'value' => function($data){
												//return substr($data->tanggalwaktu, 0, -7);;
												return $data->tanggalwaktu;
											},
										],
										[
											//'attribute' => 'gambar',
											'label' => 'Gambar',
											'format' => 'html',
											'value' => function($data){
												$imageLink = "";
												$images = Images::find()->where(['caseId' => (string) $data->caseid])->asArray()->limit(1)->all();
												foreach ($images as $img){
													return  "<img src=".Yii::$app->request->baseUrl.'/uploads/'.$img['imageFiles']."
													width='300px' height='auto'>";
												}
											},
											'header' => 'Gambar',
										],
										'location','description',
										[
											'attribute' => 'status',
											'label' => 'Status',
											'value' => function($data){
												return $data->status;
											},
											//'visible' => true,
											'header' => 'Status',
											//'footer' => 'Gambar'
										],
									],
					]);



					?>
				</div>

			</div>
		</div>


    </div>
    <!-- Jquery JS-->
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="vendor/slick/slick.min.js">
    </script>
    <script src="vendor/wow/wow.min.js"></script>
    <script src="vendor/animsition/animsition.min.js"></script>
    <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="vendor/select2/select2.min.js">
    </script>

    <!-- Main JS-->
    <script src="js/main.js"></script>
