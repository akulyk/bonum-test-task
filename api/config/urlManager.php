<?php

use yii\rest\UrlRule;
use yii\web\UrlManager;
use yii\web\UrlRule as WebUrlRule;


return [
    'class' => UrlManager::class,
    'enablePrettyUrl' => true,
    'enableStrictParsing' => true,
    'showScriptName' => false,
    'rules' => [
        [
            'class' => WebUrlRule::class,
            'pattern' => 'documentation',
            'route' => 'documentation/doc',
        ],
        [
            'class' => WebUrlRule::class,
            'pattern' => 'documentation/<action:\w+>',
            'route' => 'documentation/<action>',
        ],
        [
            'class' => UrlRule::class,
            'controller' => ['user'],
            'pluralize' => false,
            'extraPatterns' => [
                'POST register' => 'register',
                'POST login' => 'login',
            ],
        ],
        [
            'class' => UrlRule::class,
            'controller' => ['company'],
            'pluralize' => false,
            'extraPatterns' => [

            ],
        ],
        [
            'class' => UrlRule::class,
            'controller' => ['client'],
            'pluralize' => false,
            'extraPatterns' => [
                'GET companies' => 'companies'
            ],
        ],
    ],
];
