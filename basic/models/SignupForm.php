<?php

namespace app\models;
use app\models\SignupForm;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class SignupForm extends Model
{

}

public function signup()
{
  if ($this->validate()) {
    $user = new User();
    $user->username = $this->username;
    $user->email = $this->email;
    $user->setPassword($this->password);
    $user->generateAuthKey();
    $user->save(false); //avoids validating twice
    
    $auth = \Yii::$app->authManager;
    $authorRole = $auth->getRole('author');
    $auth->assign($authorRole, $user->getId());

    return $user;
  }
  return null;
}

?>
