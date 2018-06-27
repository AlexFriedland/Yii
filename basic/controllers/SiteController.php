<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\EntryForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */



     //WHERE IS THE SESSION???
     //https://www.yiiframework.com/doc/guide/2.0/en/runtime-sessions-cookies
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            //echo Yii::$app->session->getFlash;
            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }




    // START OF CUSTOM CODE FROM https://www.yiiframework.com/doc/guide/2.0/en/start-hello

    public function actionSay($message = 'Hello')
    {
        $test = 'TEST VARIABLE';
        return $this->render('say', ['message' => $message, 'test' => $test]);
    }




    //Create action for new model EntryForm
    //https://www.yiiframework.com/doc/guide/2.0/en/start-forms
    //This action creates new EntryForm object. populates with data from $_POST
    //if successfully populated, calls validate()
    public function actionEntry()
    {
      //create new entry form object
      $model = new EntryForm();

      //Info: The expression Yii::$app represents the application instance,
      //which is a globally accessible singleton. It is also a service locator
      //that provides components such as request, response, db, etc. to support
      //specific functionality. In the above code, the request component of the
      //application instance is used to access the $_POST data.

      //populate model w data from $_POST, provided in yii\web\request::post()
      //if successfully populated AND model can be validated...
      if ($model->load(Yii::$app->request->post()) && $model->validate()) {
        //either entry-confirm page is displayed, or validation error
        return $this->render('entry-confirm', ['model' => $model]);
      } else {
        return $this->render('entry', ['model' => $model]);
      }
    }

}
