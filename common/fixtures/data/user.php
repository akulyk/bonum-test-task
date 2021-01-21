<?php

use common\models\User;
$user = new User();
$user->setPassword('password');
$user->generateAuthKey();
return [
    [
        'id'=> 1,
        'username' => 'admin',
        'email' => 'admin@site.test',
        'auth_key' =>$user->auth_key,
        //password
        'password_hash' => $user->password_hash,
        'status' => User::STATUS_ACTIVE,
        'created_at' => time(),
        'updated_at' => time(),
    ],

];
