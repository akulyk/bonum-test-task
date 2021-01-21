<?php

declare(strict_types=1);

namespace api\tests\fixtures;

use yii\test\ActiveFixture;
use api\models\auth\User as UserEntity;

/**
 * Class UserFixture
 */
class UserFixture extends ActiveFixture
{
    public $modelClass = UserEntity::class;
}
