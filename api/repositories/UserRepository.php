<?php

declare(strict_types=1);

namespace api\repositories;

use api\models\auth\User as UserEntity;
use Yii;

/**
 * Class UserRepository
 */
class UserRepository
{
    /**
     * @param string $email
     *
     * @return UserEntity|null
     */
    public function getByEmail(string $email): ?UserEntity
    {
        return $email ? UserEntity::findOne(['email' => $email]) : null;
    }

    /**
     * Get user by id
     *
     * @param string $id
     *
     * @return UserEntity|null
     */
    public function getById(string $id): ?UserEntity
    {
        return $id ? UserEntity::findOne(['id' => $id]) : null;
    }

    /**
     * @param UserEntity $userEntity
     * @param bool       $runValidation
     *
     * @return bool
     */
    public function save(UserEntity $userEntity, bool $runValidation = true): bool
    {
        if (! $userEntity->save($runValidation)) {
            Yii::error(
                sprintf(
                    'Failed to save user. Errors: %s. Attributes: %s',
                    json_encode($userEntity->getErrors()),
                    json_encode($userEntity->getAttributes())
                ),
                __METHOD__
            );

            return false;
        }

        return true;
    }
}
