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

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        if(Yii::$app->user->can('view-home')){
            return $this->render('index');
        }else{
            return $this->redirect(['/site/login']);
        }
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
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

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionForm()
    {
        if(Yii::$app->user->can('create-form')){
            $model = new \app\models\Forms();
            $images = new \app\models\UploadForm();
            $notes = new Notes();

            if ($model->load(Yii::$app->request->post())) {
                //var_dump(Yii::$app->request->post());
                $images->imageFiles = UploadedFile::getInstances($images, 'imageFiles');

                date_default_timezone_set('Asia/Jakarta');
                $time = new \DateTime();
                $times = $time->format("Y-m-d_H-i-s");
                $time->modify("+5 day");
                $casedue = $time->format("Y-m-d_H-i-s");
                //$time = date('Y-m-d_H-i-s');
                // echo $time->format("Y-m-d_H-i-s");
                $id = $model->saveData($times, $casedue);//buat save data formnya
                $images->upload($id,$times);//buat upload gambar di folder
                $notes->createNotes($id,'1');
                $notes->createNotes($id,'2');
                //$id = $model->getId();
                //$images->saveData($id,$time);//buat save data gambar yang diupload

                if ($model->check(Yii::$app->request->post())) {
                    Yii::$app->session->setFlash('success', 'Thank you for contacting us.');
                } else {
                    Yii::$app->session->setFlash('error', 'There was an error sending your message.');
                }

                return $this->refresh();
            } else {
                //echo "asd";
                // $model = new FormForm();
                // var_dump($model->getForms());
                return $this->render('form', [
                    'model' => $model,
                    'images' => $images
                ]);
            }
        }else{
            return $this->redirect(['/site/login']);
        }
        
    }

    // public function actionUpload()
    // {
    //     $images = new UploadForm();

    //     if (Yii::$app->request->isPost) {
    //         $images->imageFile = UploadedFile::getInstances($images, 'imageFile');
    //         if ($images->upload()) {
    //             echo "masukk";
    //             // file is uploaded successfully
    //             //return;
    //         }else{
    //             echo "kaga cuy";
    //         }
    //     }

    //     //return $this->render('upload', ['images' => $images]);
    // }

    // public function actionFormAdmin(){

    //     return $this->render('FormAdmin');
    // }

}
