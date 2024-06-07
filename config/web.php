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
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'yXHkoiCnrIzpUMxAdbpkkALCCxBaOn2-',
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
            'class' => \yii\symfonymailer\Mailer::class,
            'viewPath' => '@app/mail',
            // send all mails to a file by default.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => ['libro'],
                    'except' => ['index', 'view'], // Excluir acciones generadas automáticamente
                    'extraPatterns' => [
                        'GET advanced' => 'index',
                        'GET {id}/autores' => 'view',
                        'POST' => 'create', // Endpoint POST para crear un libro
                        'PUT {id}' => 'update', // Endpoint PUT para actualizar un libro
                        'DELETE {id}' => 'delete', // Endpoint DELETE para eliminar un libro
                    ],
                ],
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => ['autor'],
                    'except' => ['index', 'view'], // Excluir acciones generadas automáticamente
                    'extraPatterns' => [
                        'GET advanced' => 'index',
                        'POST' => 'create', // Endpoint POST para crear un autor
                        'PUT {id}' => 'update', // Endpoint PUT para actualizar un autor
                        'DELETE {id}' => 'delete', // Endpoint DELETE para eliminar un autor
                    ],
                ],
            ],
        ],
        
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

return $config;
