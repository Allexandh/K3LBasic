<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "forms".
 *
 * @property int $caseid
 * @property string $phonenum
 * @property string $name
 * @property string $location
 * @property string $tanggalwaktu
 * @property string $description
 * @property string $gambar
 * @property string $casedue
 * @property string $email
 * @property string $status
 */
class Forms extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'forms';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['phonenum', 'name', 'location', 'tanggalwaktu', 'description', 'gambar', 'casedue', 'email', 'status'], 'required'],
            // [['caseId'],'int'],
            [['tanggalwaktu', 'casedue'], 'safe'],
            [['phonenum'], 'string', 'max' => 20],
            [['name'], 'string', 'max' => 50],
            [['location', 'description', 'gambar', 'email'], 'string', 'max' => 100],
            [['status'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'caseid' => 'Caseid',
            'phonenum' => 'Phonenum',
            'name' => 'Name',
            'location' => 'Location',
            'tanggalwaktu' => 'Tanggalwaktu',
            'description' => 'Description',
            'gambar' => 'Gambar',
            'casedue' => 'Casedue',
            'email' => 'Email',
            'status' => 'Status',
        ];
    }


    public function saveData($time){
        $forms = new Forms();
        //$forms->caseid = $this->caseid; auto increment
        $forms->phonenum = $this->phonenum;
        $forms->name = $this->name;
        $forms->location = $this->location;
        $forms->description = $this->description;
        $forms->gambar = "kosong";

        $forms->email = "Email";

        $forms->tanggalwaktu = $time;
        $forms->casedue = $time;
        $forms->status = "Process";
        //echo $forms->name;
        $forms->save();
        return $forms->getId();
        //return $this->name;
    }

    public function getForms(){
        $forms = new Forms();
        return $forms->getForms();
    }

    public function check(){
        return $this->name;
        //return true;
    }

    public function getId()
    {   
        return $this->getPrimaryKey();
        //return $this->getPrimaryKey();
    }

    public function getImages()
{
    return $this->hasOne(Images::className(), ['caseId'=> 'caseid']);
}

}
