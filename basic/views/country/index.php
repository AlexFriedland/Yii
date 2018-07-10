<?php

use yii\helpers\Html;
use yii\grid\GridView;

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
