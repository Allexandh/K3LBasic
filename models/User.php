<?php

namespace app\models;
use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

//comment di bawah ini yang aslinya(waktu pertama buat), diganti biar jadi activerecord(model) dan bisa dipake buat crud
//class User extends \yii\base\BaseObject implements \yii\web\IdentityInterface
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    // public $id;
    // public $username;
    //  public $password;
    //  public $authKey;
    //  public $accessToken;

    // private static $users = [
    //     '100' => [
    //         'id' => '100',
    //         'username' => 'admin',
    //         'password' => 'admin',
    //         'authKey' => 'test100key',
    //         'accessToken' => '100-token',
    //     ],
    //     '101' => [
    //         'id' => '101',
    //         'username' => 'demo',
    //         'password' => 'demo',
    //         'authKey' => 'test101key',
    //         'accessToken' => '101-token',
    //     ],
    // ];


   //////// nanti di uncomment lagi yang bagian ini
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


    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        // return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
        return static::findOne($id);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        // foreach (self::$users as $user) {
        //     if ($user['accessToken'] === $token) {
        //         return new static($user);
        //     }
        // }

        // return null;
        return static::findOne(['access_token' => $token]);
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByEmail($email)
    {
        // foreach (self::$users as $user) {
        //     if (strcasecmp($user['username'], $username) === 0) {
        //         return new static($user);
        //     }
        // }

        // return null;
        return static::findOne(['email' => $email]);
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    public function findAllUser(){
        //return static::find()->all();
        return ArrayHelper::map(User::find()->where(['status'=>'Supervisor'])->all(),'email', 'username', 'status_detail');
    }


    // public function findStatus($supervisor){
    //     if (($model = User::find()->select('username, status_detail')->where(['email'=>$supervisor])->One()) !== null) {
    //         return $model;
    //     }
    // }


    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        // return $this->password === $password;
        return $this->password === sha1($password);
    }
}

    // public function rules()
    // {
    //     return [
    //         ['id',
    //         'username',
    //         'auth_key',
    //         'password',
    //         'password_reset_token',
    //         'email:email',
    //         'status',
    //         'created_at',
    //         'updated_at',
    //         'verification_token'
    //         ],
    //     ];
    // }

    // public function attributeLabels()
    // {
    //     return [
    //         'id' => 'id',
    //         'username' => 'username',
    //         'auth_key' => 'auth_key',
    //         'password' => 'password',
    //         'password_reset_token' => 'password_reset_token',
    //         'email' => 'email',
    //         'status' => 'status',
    //         'created_at' => 'created_at',
    //         'updated_at' => 'updated_at',
    //         'verification_token' => 'verification_token',
    //     ];
    // }
