<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\jui\DatePicker;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;
use yii\data\Pagination;
use app\models\Country;
use app\models\CountrySearch;
use yii\data\Sort;

#$this->registerCss("body { background: #f00; }");






/* @var $this yii\web\View */
/* @var $searchModel app\models\CountrySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Countries';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php date_default_timezone_set('UTC'); ?>
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

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Country', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

/* for multiple grid views on one page see output-data-widgets */
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'code',
            'name',
            'population',
            #ActionColumn displays actions from controller..
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


    <?php

    #pagination
    $query = Country::find()->where(['population' => 1]);

    // get the total number of articles (but do not fetch the article data yet)
    $count = $query->count();

    // create a pagination object with the total count
    $pagination = new Pagination(['totalCount' => $count]);
    $pagination->route = 'country/index';

    // limit the query using the pagination and retrieve the articles
    $countries = $query->offset($pagination->offset)
        ->limit($pagination->limit)
        ->all();
     ?>

     <div># pagination doesn't appear
       <a href="<?= $pagination->createUrl(0); ?>"></a>
     </div>
</div>
