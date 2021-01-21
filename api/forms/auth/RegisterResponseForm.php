<?php

declare(strict_types=1);

namespace api\forms\auth;

use Lcobucci\JWT\Token;
use yii\base\Model;

/**
 * @OA\Schema(
 *     schema="RestRegisterResponse",
 *
 *     @OA\Property(
 *          property="jwt",
 *          type="string",
 *          example="eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VybmFtZSI6IkJsYSIsImVtYWlsIjoiQmxhIiwiZmlyc3RfbmFtZSI6IkJsYSIsImxhc3RfbmFtZSI6IkJsYSIsInBybyI6ZmFsc2UsInByb0RhdGEiOltdfQ.YdlGoA4OFFAAghia6a0h6-UMOlo0BiTrWkuA1tDxaKY"
 *      )
 * )
 *
 * Register response form.
 */
class RegisterResponseForm extends Model
{
    protected ?Token $jwt;

    public function __construct(Token $jwt = null)
    {
        $this->jwt = $jwt;

        parent::__construct([]);
    }

    public function fields(): array
    {
        return [
            'jwt' => function () {
                return (string) $this->jwt;
            },
        ];
    }
}
