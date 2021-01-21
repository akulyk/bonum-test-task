<?php

declare(strict_types=1);

namespace api\services;

use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Signer\Key;
use Lcobucci\JWT\Token;
use sizeg\jwt\Jwt as BaseJwt;
use Throwable;
use Yii;
use yii\base\InvalidArgumentException;

class Jwt extends BaseJwt
{
    private const KEY_WORD = 'ClientCompany';

    public string $schema = 'Bearer';

    protected ?Token $token = null;

    protected ?string $stringToken = null;

    public function __construct($config = [])
    {
        $this->key = new Key(self::KEY_WORD);

        parent::__construct($config);
    }

    /**
     * @return null|Token
     *
     * @throws Throwable
     */
    public function getToken(): ?Token
    {
        if ($this->token) {
            return $this->token;
        }
        if ($tokenAsString = $this->getTokenFromHeadersAsString()) {
            $this->token = $this->loadToken($tokenAsString);
        }

        return $this->token;
    }

    /**
     * Generates Token by given user data.
     *
     * @param array $userData associative array of user fields and values
     * @param null $expires
     *
     * @return Token
     */
    public function generateToken(array $userData, $expires = null): Token
    {
        $builder = $this->getBuilder();
        foreach ($userData as $field => $value) {
            if (! is_string($field)) {
                throw new InvalidArgumentException('Wrong "$userData" format.');
            }
            $builder->withClaim($field, $value);
        }
        if (null !== $expires) {
            $builder->expiresAt($expires);
        }

        return $builder->getToken(new Sha256(), $this->key);
    }

    /**
     * @return null|string
     */
    private function getTokenFromHeadersAsString(): ?string
    {
        if ($this->stringToken) {
            return $this->stringToken;
        }
        $authHeader = Yii::$app->request->getHeaders()->get('Authorization');
        if (null !== $authHeader && preg_match('/^' . $this->schema . '\s+(.*?)$/', $authHeader, $matches)) {
            $this->stringToken = $matches[1];
        }

        return $this->stringToken;
    }
}
