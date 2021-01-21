<?php

use yii\web\JsonParser;
use yii\web\JsonResponseFormatter;
use yii\web\Request;
use yii\web\Response;

$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php',
    );

return [
    'id' => 'api',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
    ],
    'controllerNamespace' => 'api\controllers',
    'components' => [
        'request' => [
            'class' => Request::class,
            'enableCookieValidation' => false,
            'parsers' => [
                'application/json' => JsonParser::class,
            ],
        ],
        'response' => [
            'formatters' => [
                Response::FORMAT_JSON => [
                    'class' => JsonResponseFormatter::class,
                ],
            ],
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
        'urlManager' => require __DIR__ . '/urlManager.php',
    ],
    'container' => require __DIR__ . '/container.php',
    'params' => $params,
];
