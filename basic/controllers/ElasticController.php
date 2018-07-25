<?php

  namespace app\controllers;

  use app\models\elastic;
  use yii\web\Controller;

  class ElasticController extends Controller
  {

    public function actionIndex()
    {
      $elastic = new elastic();
      $elastic->name = "USA";
      $elastic->code = "US";
      $elastic->population = 322976000;

      if ($elastic->insert()) {
        echo "Added successfully";
      } else {
        echo "Error";
      }
    }

  }

 ?>
