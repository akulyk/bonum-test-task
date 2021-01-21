<?php

declare(strict_types=1);

namespace api\components;

use api\models\auth\User as UserEntity;
use api\repositories\UserRepository;
use Lcobucci\JWT\Token;
use OutOfBoundsException;
use Throwable;
use Yii;
use yii\base\InvalidConfigException;
use yii\web\IdentityInterface;
use yii\web\User;
use api\services\Jwt;

class ApiUser extends User
{

    protected UserRepository $repository;
    protected Jwt $jwt;
    /**
     * User constructor.
     * @param UserRepository $repository
     * @param Jwt $jwt
     * @param array $config
     */
    public function __construct(
        UserRepository $repository,
        Jwt $jwt,
        array $config = []
    )
    {
        $this->jwt = $jwt;
        $this->repository = $repository;
        parent::__construct($config);
    }

    public function getJwt(): Jwt
    {
        return $this->jwt;
    }

    public function getById(string $id): ?UserEntity
    {
        return $this->repository->getById($id);
    }

    /**
     * @param bool $autoRenew
     * @return null|IdentityInterface
     * @throws InvalidConfigException
     * @throws Throwable
     */
    public function getIdentity($autoRenew = true): ?IdentityInterface
    {
        return $this->getIdentityByToken($this->jwt->getToken());
    }

    /**
     * @param null | Token $token
     * @throws InvalidConfigException
     * @return null|IdentityInterface
     */
    public function getIdentityByToken(?Token $token = null): ?IdentityInterface
    {
        if (! $token) {
            return null;
        }

        try {
            /** @var UserEntity $identity */
            $identity = Yii::createObject($this->identityClass);
            $identity->loadByToken($token);
            return $identity;
        } catch (OutOfBoundsException $exception) {
            Yii::error(
                sprintf(
                    'Cannot load JWT "%s". Exception message = %s. Exception stack trace = %s',
                    $token,
                    $exception->getMessage(),
                    $exception->getTraceAsString()
                ),
                __METHOD__
            );

            return null;
        }
    }

}
