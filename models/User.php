<?php

namespace app\models;
use Yii;
use yii\db\ActiveRecord;
//comment di bawah ini yang aslinya(waktu pertama buat), diganti biar jadi activerecord(model) dan bisa dipake buat crud
//class User extends \yii\base\BaseObject implements \yii\web\IdentityInterface
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    // public $id;
    // public $username;
     public $password;
     public $authKey;
     public $accessToken;

    private static $users = [
        '100' => [
            'id' => '100',
            'username' => 'admins',
            'password' => 'admins',
            'authKey' => 'test100key',
            'accessToken' => '100-token',
        ],
        '101' => [
            'id' => '101',
            'username' => 'demo',
            'password' => 'demo',
            'authKey' => 'test101key',
            'accessToken' => '101-token',
        ],
    ];

    public function rules()
    {
        return [
            [['username', 'auth_key', 'password_hash', 'email', 'created_at', 'updated_at'], 'required'],
            [['created_at', 'updated_at'], 'integer'],
            [['username', 'password_hash', 'password_reset_token', 'email', 'verification_token'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['status'], 'string', 'max' => 20],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
        ];
    }

    // public function rules()
    // {
    //     return [
    //         ['id',
    //         'username',
    //         'auth_key',
    //         'password_hash',
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
    //         'password_hash' => 'password_hash',
    //         'password_reset_token' => 'password_reset_token',
    //         'email' => 'email',
    //         'status' => 'status',
    //         'created_at' => 'created_at',
    //         'updated_at' => 'updated_at',
    //         'verification_token' => 'verification_token',
    //     ];
    // }


    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        foreach (self::$users as $user) {
            if (strcasecmp($user['username'], $username) === 0) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === $password;
    }
}
