<?php

declare(strict_types=1);

namespace tests\codeception\api;

use api\services\UserService;
use api\tests\ApiTester;
use api\tests\helpers\AuthHelper;
use api\tests\helpers\FixtureHelper;
use api\tests\helpers\JwtHelper;
use api\models\auth\User as UserEntity;
use Throwable;
use Yii;
use yii\base\InvalidConfigException;
use yii\di\NotInstantiableException;

class UserCest
{
    /**
     * @param ApiTester $I
     */
    public function reloadFixtures(ApiTester $I): void
    {
        $I->haveFixtures(FixtureHelper::getAllFixtures());
    }

    /**
     * @param ApiTester $I
     *
     * @throws InvalidConfigException
     * @throws NotInstantiableException
     * @throws Throwable
     */
    public function testRegister(ApiTester $I): void
    {
        $this->reloadFixtures($I);
        AuthHelper::setHeadersWithoutAuthorization($I);
        $I->sendPOST('/user/register', [
            'email' => 'testuser@gmail.com',
            'password' => '58586756',
        ]);
        $I->seeResponseCodeIs(201);
        $I->seeResponseIsJson();
        $I->seeResponseMatchesJsonType([
            'jwt' => 'string',
        ]);
        $jwt = $I->grabDataFromResponseByJsonPath('$[jwt]')[0];
        $I->assertTrue(JwtHelper::validateJwt($jwt));
        $userId = JwtHelper::getIdFromJwt($jwt);
        $I->assertNotNull($userId);
        /** @var UserEntity $createdUser */
        $createdUser = UserEntity::find()->where(['id' => $userId, 'email' => 'testuser@gmail.com'])->limit(1)->one();
        $I->assertNotNull($createdUser);
        $I->assertNotNull($createdUser->token_expiration_time);
        $I->assertNotNull($createdUser->token_expiration_time);
        $I->assertEqualsWithDelta(time() + Yii::$app->params['JwtTimeToLive'],  $createdUser->token_expiration_time, 10);
    }

    /**
     * @param ApiTester $I
     */
    public function testRegisterWithErrors(ApiTester $I): void
    {
        $this->reloadFixtures($I);
        $url = '/user/register';

        $I->wantToTest('Required fields');
        AuthHelper::setHeadersWithoutAuthorization($I);
        $I->sendPOST($url);
        $I->seeResponseCodeIs(422);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson([
            'errors' => [
                [
                    'field' => 'email',
                    'message' => 'Email cannot be blank.',
                ],
                [
                    'field' => 'password',
                    'message' => 'Password cannot be blank.',
                ],
            ],
        ]);

        $I->wantToTest('Wrong email format');
        AuthHelper::setHeadersWithoutAuthorization($I);
        $I->sendPOST($url, [
            'email' => 'rightTestUser',
            'password' => '11111111',
        ]);
        $I->seeResponseCodeIs(422);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson([
            'errors' => [
                [
                    'field' => 'email',
                    'message' => 'Email is not a valid email address.',
                ],
            ],
        ]);
    }

    /**
     * @param ApiTester $I
     *
     * @throws InvalidConfigException
     * @throws NotInstantiableException
     * @throws Throwable
     */
    public function testLogin(ApiTester $I): void
    {
        $this->reloadFixtures($I);
        AuthHelper::setHeadersWithoutAuthorization($I);
        $I->sendPOST('/user/login', [
            'email' => 'broderick09@yahoo.com',
            'password' => '123456',
        ]);
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseMatchesJsonType([
            'jwt' => 'string',
        ]);
        $jwt = $I->grabDataFromResponseByJsonPath('$[jwt]')[0];
        $I->assertTrue(JwtHelper::validateJwt($jwt));
        $userId = JwtHelper::getIdFromJwt($jwt);
        $I->assertNotNull($userId);
        /** @var UserEntity $loggedUser */
        $loggedUser = UserEntity::find()->where(['id' => $userId, 'email' => 'broderick09@yahoo.com'])->limit(1)->one();
        $I->assertNotNull($loggedUser);
        $I->assertNotNull($loggedUser->token_expiration_time);
        $I->assertNotNull($loggedUser->token_expiration_time);
        $I->assertEqualsWithDelta(time() + Yii::$app->params['JwtTimeToLive'],  $loggedUser->token_expiration_time, 10);
    }

    /**
     * @param ApiTester $I
     */
    public function testLoginWith422(ApiTester $I): void
    {
        $this->reloadFixtures($I);
        $url = '/user/login';

        $I->wantToTest('Required fields');
        AuthHelper::setHeadersWithoutAuthorization($I);
        $I->sendPOST($url);
        $I->seeResponseCodeIs(422);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson([
            'errors' => [
                [
                    'field' => 'email',
                    'message' => 'Email cannot be blank.',
                ],
                [
                    'field' => 'password',
                    'message' => 'Password cannot be blank.',
                ],
            ],
        ]);

        $I->wantToTest('Wrong password');
        AuthHelper::setHeadersWithoutAuthorization($I);
        $I->sendPOST($url, [
            'email' => 'broderick09@yahoo.com',
            'password' => '11111111',
        ]);
        $I->seeResponseCodeIs(422);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson([
            'errors' => [
                [
                    'field' => 'password',
                    'message' => 'Incorrect email or password.',
                ],
            ],
        ]);

        $I->wantToTest('Wrong email');
        AuthHelper::setHeadersWithoutAuthorization($I);
        $I->sendPOST($url, [
            'email' => 'rightTestUser',
            'password' => '11111111',
        ]);
        $I->seeResponseCodeIs(422);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson([
            'errors' => [
                [
                    'field' => 'email',
                    'message' => 'Email is not a valid email address.',
                ],
            ],
        ]);

        $I->wantToTest('There is no user in DB');
        AuthHelper::setHeadersWithoutAuthorization($I);
        $I->sendPOST($url, [
            'email' => 'wrongTestUser@gmail.com',
            'password' => '11111111',
        ]);
        $I->seeResponseCodeIs(422);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson([
            'errors' => [
                [
                    'field' => 'email',
                    'message' => 'Such member not found.',
                ],
            ],
        ]);
    }
}
