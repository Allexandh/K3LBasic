<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "notes".
 *
 * @property int $id
 * @property string $formid
 * @property string $notes
 * @property string $source
 */
class Notes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'notes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            //[['formid', 'source'], 'required'],
            [['source','formid'], 'string', 'max' => 50],
            [['notes'], 'string', 'max' => 100],
            //[['id'], 'integer', 'max' => 5],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'formid' => 'Formid',
            'notes' => 'Notes',
            'source' => 'Source',
        ];
    }

    //mencari notes dari suatu form
    public function noteSearch($id,$role){
        return Notes::find()->select('notes')->where(['formid'=>$id,'source'=>$role])->one();
    }

    // public function findNotes($id,$role){
    //     //return Notes::find()->select('notes')->where(['formid'=>$id])->one();
    //     return Notes::find()->where(['formid'=>$id,'source'=>$role])->indexBy('id')->one();
    // }

    //membuat notes
    public function createNotes($id,$source){
        $notes = new Notes();
        $notes->formid=strval($id);
        $notes->notes="";
        //source itu asalnya, 1 = dari admin, 2 dari supervisor
        $notes->source=$source;
        return $notes->save();
    }
}
