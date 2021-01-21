<?php

declare(strict_types=1);

namespace api\services;

use api\forms\auth\LoginForm;
use api\forms\auth\LoginResponseForm;
use api\forms\auth\RegisterForm;
use api\forms\auth\RegisterResponseForm;
use api\models\auth\interfaces\JwtTokenizable;
use api\models\auth\User as UserEntity;
use api\repositories\UserRepository;
use Lcobucci\JWT\Token;
use Yii;
use yii\base\Exception;
use yii\base\InvalidConfigException;
use yii\base\Model;
use yii\base\Security;

class UserService
{
    protected ModelHandler $modelHandler;
    protected UserRepository $userRepository;
    protected Security $security;
    protected Jwt $jwt;

    public function __construct(ModelHandler $modelHandler,
                                UserRepository $userRepository,
                                Jwt $jwt,
                                Security $security
        ){

        $this->modelHandler = $modelHandler;
        $this->userRepository = $userRepository;
        $this->security = $security;
        $this->jwt = $jwt;
    }

    /**
     * Login user with form data
     * @param LoginForm $loginForm
     * @return LoginResponseForm
     * @throws InvalidConfigException
     */
    public function loginByForm(LoginForm $loginForm): Model
    {
        if (! $loginForm->validate()) {
            return $this->modelHandler->createModel(
                LoginResponseForm::class,
                $loginForm->getErrors(),
                null
            );
        }

        $userEntity = $this->userRepository->getByEmail((string) $loginForm->email);
        if (null === $userEntity) {
            return $this->modelHandler->createModel(
                LoginResponseForm::class,
                ['email' => Yii::t('app', 'Such member not found.')],
                null
            );
        }

        if (! $this->security->validatePassword($loginForm->password, $userEntity->password_hash)) {
            return $this->modelHandler->createModel(
                LoginResponseForm::class,
                ['password' => Yii::t('app', Yii::t('app', 'Incorrect email or password.'))],
                null
            );
        }

        $userEntity->token_expiration_time = time() + Yii::$app->params['JwtTimeToLive'];
        if (! $this->userRepository->save($userEntity)) {
            return $this->modelHandler->createModel(
                LoginResponseForm::class,
                $userEntity->getErrors(),
                null
            );
        }

        return $this->modelHandler->createModel(
            LoginResponseForm::class,
            null,
            [$this->renewToken($userEntity)]
        );
    }

    /**
     * Sign up user into system
     * @param RegisterForm $registerForm
     * @return RegisterResponseForm
     * @throws Exception
     */
    public function register(RegisterForm $registerForm): Model
    {
        if (! $registerForm->validate()) {
            return $this->modelHandler->createModel(RegisterResponseForm::class, $registerForm->getErrors(), null);
        }
        $userEntity = $this->setUserData($registerForm);
        if (! $this->userRepository->save($userEntity)) {
            return $this->modelHandler->createModel(RegisterResponseForm::class, $userEntity->getErrors(), null);
        }

        return $this->modelHandler->createModel(RegisterResponseForm::class, null, [$this->renewToken($userEntity)]);
    }

    public function renewToken(JwtTokenizable $identity): Token
    {
        $tokenFields = $identity->fieldsForJwtToken();

        return $this->jwt->generateToken($identity->toArray($tokenFields), isset(Yii::$app->params['JwtTimeToLive']) ? time() + Yii::$app->params['JwtTimeToLive'] : null);
    }

    public function save(UserEntity $userEntity, bool $runValidation = true): bool
    {
        return $this->userRepository->save($userEntity, $runValidation);
    }

    /**
     * @param RegisterForm $registerForm
     * @return UserEntity
     * @throws Exception
     */
    protected function setUserData(RegisterForm $registerForm): UserEntity
    {
        $userEntity = new UserEntity();
        $userEntity->email = $registerForm->email;
        $userEntity->password_hash = $this->security->generatePasswordHash($registerForm->password);
        $userEntity->token_expiration_time = time() + Yii::$app->params['JwtTimeToLive'];
        $userEntity->generateAuthKey();

        return $userEntity;
    }
}
