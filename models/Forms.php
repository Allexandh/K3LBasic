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
 * @property string $casedue
 * @property string $email
 * @property string $status
 */
//model/class dari forms
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
            [['phonenum', 'location', 'description'], 'required'],
            [['caseid'],'integer'],
            [['tanggalwaktu', 'casedue'], 'safe'],
            [['phonenum'], 'string', 'max' => 20],
            [['location', 'description', 'email'], 'string', 'max' => 100],
            [['status'], 'string', 'max' => 20],
            [['supervisor'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'caseid' => 'Caseid',
            'phonenum' => 'Phone Number',
            'location' => 'Location',
            'tanggalwaktu' => 'Tanggalwaktu',
            'description' => 'Description',
            // 'gambar' => 'Gambar',
            'casedue' => 'Casedue',
            'email' => 'Email',
            'status' => 'Status',
        ];
    }

    //ini untuk menyimpan data form
    public function saveData($time, $casedue){
        $forms = new Forms();
        $forms->phonenum = $this->phonenum;
        $forms->location = $this->location;
        $forms->description = $this->description;
        $forms->email = Yii::$app->user->identity->email;
        $forms->tanggalwaktu = $time;
        $forms->casedue = 0;
        $forms->status = "Pemeriksaan";
        $forms->supervisor = "None";
        $forms->save();
        return $forms->getId();
    }

    public function getForms(){
        $forms = new Forms();
        return $forms->getForms();
    }

    public function check(){
        return Yii::$app->user->identity->username;
    }

    public function getId()
    {   
        return $this->getPrimaryKey();
    }

    public function getImages()
    {
        return $this->hasOne(Images::className(), ['caseId'=> 'caseid']);
    }

}
