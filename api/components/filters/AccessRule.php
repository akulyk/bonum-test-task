<?php

declare(strict_types=1);

namespace api\components\filters;

use api\components\ApiUser;
use api\components\ApiUser as UserService;
use api\services\Jwt;
use Throwable;
use yii\base\Action;
use yii\filters\AccessRule as BaseAccessRule;
use yii\web\Request;
use yii\web\UnauthorizedHttpException;
use yii\web\User;


/**
 * This class represents an access rule defined by the [[AccessControl]] action filter.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 *
 * @since 2.0
 */
class AccessRule extends BaseAccessRule
{
    /**
     * Checks whether the API user is allowed to perform the specified action.
     *
     * @param Action $action the action to be performed
     * @param Request $request
     * @param User $user
     *
     * @return null|bool true if the user is allowed, false if the user is denied, null if the rule does not apply to the user
     *
     * @throws UnauthorizedHttpException
     * @throws Throwable
     */
    public function allowsApi(Action $action, Request $request, User $user): ?bool
    {
        /** @var ApiUser $user */
        if ($this->matchJwt($user->getJwt(), $user) && $this->allows($action, $user, $request)) {
            return $this->allow;
        }

        return null;
    }

    /**
     * @param User|UserService $user
     *
     * @return bool
     *
     * @throws Throwable
     */
    private function isTokenNotExpired(User $user): bool
    {
        if (($token = $user->getJwt()->getToken()) && $token->hasClaim('id')) {
            $userEntity = $user->getById((string) $token->getClaim('id'));

            return $userEntity && $userEntity->token_expiration_time && $userEntity->token_expiration_time > time();
        }

        return false;
    }

    /**
     * @param Jwt $jwt
     * @param User|UserService $user
     *
     * @return bool whether the rule applies to the role
     *
     * @throws Throwable
     * @throws UnauthorizedHttpException
     */
    private function matchJwt(Jwt $jwt, User $user): bool
    {
        if (empty($this->roles)) {
            return true;
        }
        foreach ($this->roles as $role) {
            if ('?' !== $role) {
                if (
                    ! $jwt->getToken()
                    || ! $jwt->validateToken($jwt->getToken())
                    || ! $this->isTokenNotExpired($user)
                ) {
                    throw new UnauthorizedHttpException();
                }

                return true;
            }
        }

        return true;
    }
}
