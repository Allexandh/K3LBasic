<?php

namespace app\controllers;

use Yii;
use app\models\Forms;
use app\models\FormsSearch;
use app\models\User;
use app\models\Notes;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\base\Model;
/**
 * FormsController implements the CRUD actions for Forms model.
 */
class FormsController extends Controller
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
     * Lists all Forms models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(Yii::$app->user->can('view-form')){
            $searchModel = new FormsSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            if(Yii::$app->user->identity->status=="Supervisor"){
                $dataProvider->query->where('supervisor = \''.Yii::$app->user->identity->email.'\'');
            }

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }else{
            return $this->redirect(['/site/index']);
        }

        
    }

    /**
     * Displays a single Forms model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {

        if(Yii::$app->user->can('view-form')){
            //$user = User::findAllUser2();
            $model = $this->findModel($id);
            $notes = new Notes;
            //$user = User::findStatus($model->supervisor);
            return $this->render('view', [
                'model' => $model,'notes' => $notes,
            ]);
        }else{
            return $this->redirect(['/site/index']);
        }
    }

    /**
     * Creates a new Forms model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Forms();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->caseid]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Forms model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if(Yii::$app->user->can('update-statusform')){
            $model = $this->findModel($id);
            $user = User::findAllUser();
            $notes = Notes::find()->where(['formid'=>$id])->indexBy('id')->all();

            if (Model::loadMultiple($notes, Yii::$app->request->post()) && Model::validateMultiple($notes) && $model->load(Yii::$app->request->post())) {
                if($model->supervisor != 'None' && $model->supervisor != NULL){
                    date_default_timezone_set('Asia/Jakarta');
                    $time = new \DateTime();
                    $time->modify("+5 day");
                    $model->casedue = $time->format("Y-m-d_H-i-s");
                    if($model->status == 'Pemeriksaan'){
                        $model->status = 'Proses';
                    }
                }else{
                    $model->supervisor = 'None';
                }

                foreach ($notes as $note) {
                    $note->save(false);
                }

                if($model->save()){
                    return $this->redirect(['view', 'id' => $model->caseid]);
                }
            }

            return $this->render('update', [
                'model' => $model,'user' => $user,'notes'=>$notes,
            ]);
        }else{
            return $this->redirect(['/site/index']);
        }

    }

    /**
     * Deletes an existing Forms model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {

        if(Yii::$app->user->can('delete-form')){
            $this->findModel($id)->delete();
            return $this->redirect(['index']);
        }else{
            return $this->redirect(['/site/index']);
        }
    }

    /**
     * Finds the Forms model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Forms the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */


    protected function findModel($id)
    {
        if (($model = Forms::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    public function actionPrint()
    {
        $request=Yii::$app->request->post('tableencoded');
        return $this->renderPartial('print', [
            'request' => $request,
        ]);
    }

}
