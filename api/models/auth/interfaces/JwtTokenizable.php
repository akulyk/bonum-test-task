<?php

declare(strict_types=1);

namespace api\models\auth\interfaces;

use Lcobucci\JWT\Token;

interface JwtTokenizable
{
    /**
     * @return array
     */
    public function fieldsForJwtToken(): array;

    /**
     * @param Token $token
     *
     * @return mixed
     */
    public function loadByToken(Token $token);
}
