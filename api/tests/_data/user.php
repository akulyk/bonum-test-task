<?php

return [
    [ // old user
        'id' => 1,
        'email' => 'broderick09@yahoo.com',
        'auth_key' =>  Yii::$app->security->generateRandomString(),
        'password_hash' => Yii::$app->security->generatePasswordHash(123456),
        'created_at' => time(),
        'updated_at' => time(),
        'token_expiration_time' => time() + 60 * 60 * 24 * 30, // 30 days
    ],
    [ // user with manually expired token
        'id' => 2,
        'email' => 'baron.spinka@heidenreich.com',
        'auth_key' =>  Yii::$app->security->generateRandomString(),
        'password_hash' => Yii::$app->security->generatePasswordHash(123456),
        'created_at' => time(),
        'updated_at' => time(),
        'token_expiration_time' => null,
    ],
];
