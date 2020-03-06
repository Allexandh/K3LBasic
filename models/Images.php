<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;


/**
 * This is the model class for table "images".
 *
 * @property string $caseId
 * @property string $imageFiles
 */
class Images extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'images';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['caseId', 'imageFiles'], 'required'],
            // [['caseId'], 'string', 'max' => 10],
            // [['imageFiles'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'caseId' => 'Case ID',
            'imageFiles' => 'Image Files',
        ];
    }



}
