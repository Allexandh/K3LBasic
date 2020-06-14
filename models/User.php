<?php

namespace app\models;
use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

//class atau model dari user
//menggunakan sha1 untuk password
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{

    public function rules()
    {
        return [
            [['username', 'auth_key', 'password', 'email'], 'required'],
            [['username', 'password', 'email'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['status'], 'string', 'max' => 20],
            [['status_detail'], 'string', 'max' => 50],
            [['username'], 'unique'],
            [['email'], 'unique'],
        ];
    }



    public static function tableName()
    {
        return 'user';
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    //mencari user menggunakan email
    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email]);
    }


    public function getId()
    {
        return $this->id;
    }

    //list semua user dengan status supervisor
    public function findAllUser(){
        return ArrayHelper::map(User::find()->where(['status'=>'Supervisor'])->all(),'email', 'username', 'status_detail');
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }

    //menggunakan sha1
    public function validatePassword($password)
    {
        return $this->password === sha1($password);
    }
}
