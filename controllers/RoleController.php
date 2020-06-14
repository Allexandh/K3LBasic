<?php

namespace app\controllers;

use Yii;
use app\models\User;
use app\models\RoleSearch;
use app\models\AuthAssignment;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
/**
 * RoleController implements the CRUD actions for User model.
 */
class RoleController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }


    //display daftar user
    public function actionIndex()
    {
        if(Yii::$app->user->can('view-role')){
            $searchModel = new RoleSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }else{
            return $this->redirect(['/site/login']);
        }
    }

    //melihat detail dari user sesuai dengan emailnya
    public function actionView($email)
    {
        if(Yii::$app->user->can('view-role')){
            return $this->render('view', [
                'model' => $this->findModelEmail($email),
            ]);
        }else{
            return $this->redirect(['/site/login']);
        }
        
    }

    //mencari user menggunakan email
    protected function findModelEmail($email)
    {
        if (($model = User::findOne(['email'=>$email])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


    // protected function findModel($id)
    // {
    //     if (($model = User::findOne($id)) !== null) {
    //         return $model;
    //     }
    //     throw new NotFoundHttpException('The requested page does not exist.');
    // }

    //untuk mengupdate user
    public function actionUpdate($email)
    {
        //hanya bisa dilakukan oleh admin
        if(Yii::$app->user->can('update-role')){
            $model = $this->findModelEmail($email);
            $emails = $model->email;
            $status = $model->status;
            $id = User::find()->select('id')->where(['email'=>$emails])->one();
            $oldStatus = AuthAssignment::find()->select(['item_name'])->where(['user_id'=>$id])->one();

            //mengambil data yang diupdate
            //mengubah role dari user
            if ($model->load(Yii::$app->request->post())) {
                $status = $model->status;
                $manager = Yii::$app->authManager;
                $item = $manager->getRole($oldStatus['item_name']);
                $item = $item ? : $manager->getPermission('Admin');
                $manager->revoke($item,$id['id']);
                $authorRole = $manager->getRole($status);
                $manager->assign($authorRole, $id['id']);
                $model->save();
                return $this->redirect(['view', 'email' => $model->email]);
            }

            return $this->render('update', [
                'model' => $model,
            ]);
        }else{
            return $this->redirect(['/site/login']);
        }
    }


}
