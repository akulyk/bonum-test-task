<?php

declare(strict_types=1);

namespace api\tests\helpers;

use api\services\Jwt;
use OutOfBoundsException;
use Throwable;
use Yii;
use yii\base\InvalidConfigException;
use yii\di\NotInstantiableException;

final class JwtHelper
{
    /**
     * @param string $tokenString
     *
     * @return bool
     *
     * @throws InvalidConfigException
     * @throws NotInstantiableException
     *
     * @throws Throwable
     */
    public static function validateJwt(string $tokenString): bool
    {
        if (null !== ($tokenObject = self::getJwtService()->loadToken($tokenString))) {
            return self::getJwtService()->validateToken($tokenObject);
        }

        return false;
    }

    /**
     * @param string $tokenString
     *
     * @return string|null
     *
     * @throws InvalidConfigException
     * @throws NotInstantiableException
     * @throws Throwable
     */
    public static function getIdFromJwt(string $tokenString): ?int
    {
        if (null !== ($tokenObject = self::getJwtService()->loadToken($tokenString))) {
            try {
                return $tokenObject->getClaim('id');
            } catch (OutOfBoundsException $exception) {
                return null;
            }
        }

        return null;
    }

    /**
     * @return Jwt
     *
     * @throws InvalidConfigException
     * @throws NotInstantiableException
     */
    private static function getJwtService(): Jwt
    {
        return Yii::$container->get(Jwt::class);
    }
}
