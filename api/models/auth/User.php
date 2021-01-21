<?php

declare(strict_types=1);

namespace api\models\auth;

use api\models\auth\interfaces\JwtTokenizable;
use Lcobucci\JWT\Token;


class User extends \common\models\User implements JwtTokenizable
{
    protected const FIELDS_FOR_JWT_TOKEN = [
        'id',
        'email',
    ];
    public function loadByToken(Token $token): self
    {
        $this->id = $token->getClaim('id');
        $this->email = $token->getClaim('email');

        return $this;
    }

    /**
     * @return array
     */
    public function fieldsForJwtToken(): array
    {
        return self::FIELDS_FOR_JWT_TOKEN;
    }
}
