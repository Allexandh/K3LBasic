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

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(Yii::$app->user->can('view-role')){
            $searchModel = new RoleSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            //var_dump($dataProvider);
            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }else{
            return $this->redirect(['/site/login']);
        }
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
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

    protected function findModelEmail($email)
    {
        //echo $email."  ";
        if (($model = User::findOne(['email'=>$email])) !== null) {
            return $model;
        }
        // $model = User::find()->where(['email' => $email])->one();
        // return $model;

        throw new NotFoundHttpException('The requested page does not exist.');
    }


    protected function findModel($id)
    {
        //echo $email."  ";
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }
        // $model = User::find()->where(['email' => $email])->one();
        // return $model;

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($email)
    {

        if(Yii::$app->user->can('update-role')){
            $model = $this->findModelEmail($email);

                //var_dump($model->load(Yii::$app->request->post('id')));

            $emails = $model->email;
            $status = $model->status;
            $id = User::find()->select('id')->where(['email'=>$emails])->one();

            $oldStatus = AuthAssignment::find()->select(['item_name'])->where(['user_id'=>$id])->one();
            // echo "<br><br><br><br>sebelum";
            // //var_dump($tes['item_name']);
            // echo $id['id']."<br>";
            // echo $status."<br>";
            // echo $oldStatus['item_name']."<br>";
            // echo "<br><br><br><br>";

            if ($model->load(Yii::$app->request->post())) {
                //echo "Up";
                //print_r($_POST);


                
                // $authass = AuthAssignment::findOne(['user_id'=>$id]);
                // //$authass = new AuthAssignment();
                //$authass->item_name=$status;
                // $authass->user_id=$id;
                // $authass->created_at=111;
                // var_dump($authass);
                // $authass->save();
                $status = $model->status;
                $manager = Yii::$app->authManager;
                $item = $manager->getRole($oldStatus['item_name']);
                $item = $item ? : $manager->getPermission('Admin');
                $manager->revoke($item,$id['id']);

    
                // echo $id['id']."<br>";
                // echo $status."<br>";
                // echo $oldStatus['item_name']."<br>";
                // echo "<br><br><br><br>";
                $authorRole = $manager->getRole($status);
                $manager->assign($authorRole, $id['id']);

                //Yii::$app->authManager->revoke($item , '3' );
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

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        //$this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */

}
