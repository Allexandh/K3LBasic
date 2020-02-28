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
}
