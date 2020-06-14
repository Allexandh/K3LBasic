<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\web\UploadedFile;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\UploadForm;
use app\models\Notes;
//use app\models\Forms;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    //display index/home
    //kalau belum login akan redirect ke login
    public function actionIndex()
    {
        if(Yii::$app->user->can('view-home')){
            return $this->render('index');
        }else{
            return $this->redirect(['/site/login']);
        }
    }

    //untuk login
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    //untuk logout
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    //untuk membuat form baru
    public function actionForm()
    {
        if(Yii::$app->user->can('create-form')){
            $model = new \app\models\Forms();
            $images = new \app\models\UploadForm();
            $notes = new Notes();

            if ($model->load(Yii::$app->request->post())) {
                //untuk mengupload image, namanya sesuai dengan format waktu dibawah
                $images->imageFiles = UploadedFile::getInstances($images, 'imageFiles');
                date_default_timezone_set('Asia/Jakarta');
                $time = new \DateTime();
                $times = $time->format("Y-m-d_H-i-s");
                $time->modify("+5 day");
                $casedue = $time->format("Y-m-d_H-i-s");
                $id = $model->saveData($times, $casedue);//buat save data formnya
                $images->upload($id,$times);//buat upload gambar di folder
                $notes->createNotes($id,'1');//untuk notes admin
                $notes->createNotes($id,'2');//untuk notes supervisor

                if ($model->check(Yii::$app->request->post())) {
                    Yii::$app->session->setFlash('success', 'Thank you for contacting us.');
                } else {
                    Yii::$app->session->setFlash('error', 'There was an error sending your message.');
                }

                return $this->refresh();
            } else {
                //kalau belom post form, akan ke halaman form dulu
                return $this->render('form', [
                    'model' => $model,
                    'images' => $images
                ]);
            }
        }else{
            return $this->redirect(['/site/login']);
        }
        
    }


}
