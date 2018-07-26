<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\jui\DatePicker;
use yii\widgets\ActiveForm;
use yii\data\Pagination;

?>

<?php

  //set formatting options in app config
  $formatter = \Yii::$app->formatter;

  // output: January 1, 2014
  $date =  $formatter->asDate('2018-07-26', 'long');

  // output: 12.50%
  $percent = $formatter->asPercent(0.125, 2);

  // output: <a href="mailto:cebe@example.com">cebe@example.com</a>
  $email = $formatter->asEmail('cebe@example.com');

  #output: Yes - also handles display of null values
  $boolean = $formatter->asBoolean(true);
?>

<h3>$formatter: </h3><br>
<h5>$formatter->asDate('2018-07-26', 'long') =>  <?= $date ?></h5>
<br>
<h5>$formatter->asPercent(0.125, 2) =>  <?= $percent ?></h5>
<br>
<h5>$formatter->asEmail('cebe@example.com') => <?= $email ?></h5>
<br>
<h5>$formatter->asBoolean(true) => <?= $boolean ?></h5>

<?php

/* @var $this yii\web\View */
/* @var $searchModel app\models\CountrySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Habibi, Play';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="country-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <?php echo date('h:i:s:u a, l F jS Y e') ?>
    <br>
    <?php
      $formatter = \Yii::$app->formatter;
      echo $formatter->asDate('2018-07-26', 'long');
     ?>
    <h4>Your IP: <?= Yii::$app->request->userIP; ?></h4>
    <h4>Your Host: <?= Yii::$app->request->userHost; ?></h4>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Country', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'code',
            'name',
            'population',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
