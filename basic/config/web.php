<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],

    #'MOST IMPORTANT PART'
    'components' => [

        #elasticsearch
        'elasticsearch' => [
          'class' => 'yii\elasticsearch\Connection',
          'nodes' => [
	           ['http_address' => '127.0.0.1:9200'],
             // configure more hosts if you have a cluster
           ],
         ],

        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'ziWOKlvAXaWEbW0otalzvUQ_X2hbjixH',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                    // normally this would be email error log to admin but
                    // throws error
                    // [
                    //   'class' => 'yii\log\EmailTarget',
                    //   'levels' => ['error'],
                    //   'categories' => ['yii\db\*'],
                    //   'message' => [
                    //     'from' => ['log@yii2basic.com'],
                    //     'to' => ['friedlandaj@gmail.com'],
                    //     'subject' => 'Database errors from Yii2Basic',
                    //   ]
                    // ]

                ],
            ],
        ],




        'db' => $db,

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,
            'rules' => [
              'countries' => 'country/index',
              'country/<id:\w+>' => 'country/view',
              'login' => 'site/login',
              // 'contact' => 'site/contactform',
              'entry' => 'site/entry',
              'home' => 'site/home',
              'index' => 'country/index',
              'create' => 'country/create',
              'play' => 'country/play',

              #doesn't work
              'elastic' => 'country/elastic',

              '/' => 'country/index',
            ],
        ],
        #CONTROLLERMAP NOT INCLUDED IN ORIGINAL SCAFFOLD, BUT IN DOCUMENTATION
        # https://www.yiiframework.com/doc/guide/2.0/en/structure-applications

        // 'controllerMap' => [
        // 'account' => 'app\controllers\UserController',
        // 'article' => [
        //     'class' => 'app\controllers\PostController',
        //     'enableCsrfValidation' => false,
        //     ],
        // ],

    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

#return $config;

return $config;
