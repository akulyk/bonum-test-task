<?php

use api\components\filters\AccessControlFilter;
use api\components\ApiUser;
use api\models\auth\User as UserEntity;
use api\repositories\UserRepository;
use api\services\Jwt;
use api\services\ModelHandler;
use yii\base\Security;
use yii\di\Instance;
use yii\web\User as CoreUserComponent;

return [
    'singletons' => [
        CoreUserComponent::class => ApiUser::class,
        ApiUser::class => [
            [
                'identityClass' => UserEntity::class,
                'enableSession' => false,
            ],
            [
                Instance::of(UserRepository::class),
                Instance::of(Jwt::class),
            ],
        ],
        AccessControlFilter::class => [
            [],
            [
               Instance::of(ApiUser::class),
            ],
        ],
    ]
];
