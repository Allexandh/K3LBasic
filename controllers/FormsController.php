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
use app\models\UploadForm;
use yii\web\UploadedFile;
use yii\helpers\Url;
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

    //action status sama action index dibedakan untuk filtering form sesuai dengan tombol yang dipencet (new,ongoing,finished)

    //function buat filtering form di "list form" (new,ongoing,finished)
    public function actionStatus(){
        //buat get statusnya (new/ongoing/finished)
        $request = Yii::$app->request;
        $statusForm = $id = $request->get('status');
        //cuman user tertentu yang bisa liat
        if(Yii::$app->user->can('view-form')){
            //membuat model dan query untuk form
            $searchModel = new FormsSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            //cuman bisa melihat form yang diberikan oleh admin
            if(Yii::$app->user->identity->status=="Supervisor"){
                $dataProvider->query
                ->andFilterWhere(['like', 'supervisor',Yii::$app->user->identity->email])
                ->andFilterWhere(['like', 'status',$statusForm]);
            //ini filter/query untuk admin
            }elseif(Yii::$app->user->identity->status=="Admin"){
                $dataProvider->query
                ->andFilterWhere(['like', 'status',$statusForm]);
            }

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }else{
            return $this->redirect(['/site/index']);
        } 
    }

    //display semua form untuk admin, dan form tertentu untuk supervisor
    //mirip dengan actionstatus diatas, cuman ini filter untuk supervisor saja, karena supervisor hanya bisa melihat form yang diberikan oleh admin
    public function actionIndex()
    {
        if(Yii::$app->user->can('view-form')){
            $searchModel = new FormsSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            if(Yii::$app->user->identity->status=="Supervisor"){
                $dataProvider->query->andFilterWhere(['like', 'supervisor',Yii::$app->user->identity->email]);
            }

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }else{
            return $this->redirect(['/site/index']);
        }    
    }

    //untuk melihat detail dari form yang diklik    
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

    //mengupdate form
    public function actionUpdate($id)
    {
        if(Yii::$app->user->can('update-statusform')){
            $model = $this->findModel($id);
            $user = User::findAllUser();
            $notes = Notes::find()->where(['formid'=>$id])->indexBy('id')->all();
            $images = new \app\models\UploadForm();

            //ini untuk notes supervisor dan admin
            if (Model::loadMultiple($notes, Yii::$app->request->post()) && Model::validateMultiple($notes) && $model->load(Yii::$app->request->post())) {
                //ini untuk cek apakah ada supervisor atau tidak, bila ada otomatis case duenya nambah 5 hari setelah form diberikan supervisor
                //mengubah status juga
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

                //ini untuk menyimpan gambar dari supervisor, dengan nama sesuai dengan waktu upload
                $images->imageFiles = UploadedFile::getInstances($images, 'imageFiles');
                date_default_timezone_set('Asia/Jakarta');
                $time = new \DateTime();
                $times = $time->format("Y-m-d_H-i-s");
                $images->uploadSupervisorImage($id,$times);
                
                //redirect ke detail form saat selesai update
                if($model->save()){
                    return $this->redirect(['view', 'id' => $model->caseid]);
                }
            }

            return $this->render('update', [
                'model' => $model,'user' => $user,'notes'=>$notes,'images'=>$images
            ]);
        }else{
            return $this->redirect(['/site/index']);
        }

    }

    //untuk menghapus form
    public function actionDelete($id)
    {
        if(Yii::$app->user->can('delete-form')){
            $this->findModel($id)->delete();
            return $this->redirect(['index']);
        }else{
            return $this->redirect(['/site/index']);
        }
    }

    //mencari form model berdasarkan id
    protected function findModel($id)
    {
        if (($model = Forms::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    //untuk print form
    public function actionPrint()
    {
        $request=Yii::$app->request->post('tableencoded');
        return $this->renderPartial('print', [
            'request' => $request,
        ]);
    }

}
