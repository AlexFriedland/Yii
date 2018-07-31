<?php

namespace app\models;

#need these two for using activerecord in findIdentity
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

#rule logic example - Access Check
/*
if (\Yii::$app->user->can('createPost')) {
    // create post
}
*/

#to use in findIdentity: return static::findOne($id);
#need to: class User extends ActiveRecord implements IdentityInterface

class User extends \yii\base\BaseObject implements \yii\web\IdentityInterface
{
    public $id;
    public $username;
    public $password;
    public $authKey;
    public $accessToken;

    private static $users = [
        '100' => [
            'id' => '100',
            'username' => 'admin',
            'password' => 'admin',
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
        '102' => [
            'id' => '102',
            'username' => 'alex',
            'password' => 'alex',
            'authkey' => 'test101key',
            'accessToken' => '102-token',
        ],
        '103' => [
          'id' => '103',
          'username' => 'test',
          'password' => 'test',
          'authkey' => 'test103key',
          'accessToken' => '103-token',
        ]
    ];


    /* only need to implement getAuthKey() and validateAuthKey() if your appl
       uses cookie-based login feature. use following code to generate auth key
       and store in user table.

       EVEN SO YOU STILL NEED SETAUTHKEY method i wrote below
    */

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->auth_key = \Yii::$app->security->generateRandomString();
            }
            return true;
        }
        return false;
    }


    /**
     * {@inheritdoc}
     * @param string|int $id the ID to be looked for
     * @return IdentityInterface|null the identity object that matches the given ID
     */
    public static function findIdentity($id)
    {
        return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;

        #doesn't work
        #return static::findOne($id);
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
     *
     * it returns a key used to verify cookie-based login. The key is stored in
     * the login cookie and will be later compared with the server-side version
     * to make sure the login cookie is valid.
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }



    # HABIBI - makes the added user able to login without 'read-only' error
    public function setAuthKey($key)
    {
      $this->authKey = $key;
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
