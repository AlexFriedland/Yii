<?php
  namespace app\models;

  use Yii;
  use yii\base\Model;

  class EntryForm extends Model
  {
    public $name;
    public $email;

    public function rules()
    {
      return [
        [['name', 'email'], 'required'],
        ['email', 'email'],
      ];
    }
  }

  /*
  If you have an EntryForm object populated with the data entered by a user,
  you may call its validate() method to trigger the data validation routines.
  A data validation failure will set the hasErrors property to true, and you
  may learn what validation errors occurred through errors.
  */

  $model = new EntryForm();
  $model->name = 'Qiang';
  $model->email = 'bad';
  if ($model->validate()) {
      // Good!
  } else {
      // Failure!
      // Use $model->getErrors()
  }
 ?>
