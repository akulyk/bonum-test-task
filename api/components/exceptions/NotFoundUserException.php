<?php

declare(strict_types=1);

namespace api\components\exceptions;

use DomainException;

class NotFoundUserException extends DomainException
{
    protected $message = 'There is no such user.';
}
