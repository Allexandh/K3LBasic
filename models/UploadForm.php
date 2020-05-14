<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;
use app\models\Images;


class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFiles;
    public $caseId;

    public function rules()
    {
        return [
            [['imageFiles','caseId'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg', 'maxFiles' => 3],
            //[['imageFiles','caseId'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg', 'maxFiles' => 3],
        ];
    }
    
    public function upload($id,$time)
    {
        $index = 1;

            foreach ($this->imageFiles as $file) {
                $images = new Images();
                $name = $id."_".$time."_".$index;
                //upload gambar
                $file->saveAs('uploads/' .$name. '.' . $file->extension);
                //save data
                $images->imageFiles = $name. '.' . $file->extension;
                $images->caseId = $id;
                $images->save();

                $index++;
            }
    }


    public function uploadSupervisorImage($id,$time)
    {
        $index = 1;

            foreach ($this->imageFiles as $file) {
                $images = new Images();
                $name = $id."s_".$time."_".$index;
                //upload gambar
                $file->saveAs('uploads/' .$name. '.' . $file->extension);
                //save data
                $images->imageFiles = $name. '.' . $file->extension;
                $images->caseId = $id."s";
                $images->save();

                $index++;
            }
    }



    // public function saveData($id,$time){

    //     $index = 1;
    //     //date_default_timezone_set('Asia/Jakarta');

    //     $name = $id."_".$time."_".$index;
    //     foreach ($this->imageFiles as $file) {
    //         $images = new Images();
    //         //$images->imageFiles =
    //         $images->imageFiles = $name. '.' . $file->extension;
    //         $images->caseId = $id;
    //         $index++;
    //         var_dump($images->caseId);  
    //         $images->save();
    //     }
    //     return;
    // }
}


?>