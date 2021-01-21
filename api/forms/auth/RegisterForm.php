<?php

declare(strict_types=1);

namespace api\forms\auth;

use api\models\auth\User;
use yii\base\Model;

/**
 * @OA\Schema(
 *     schema="RestRegisterForm",
 *     required={"email", "password"},
 *
 *     @OA\Property(
 *          property="email",
 *          type="string",
 *          example="email@gmail.com"
 *      ),
 *     @OA\Property(
 *          property="password",
 *          type="string",
 *          example="password12345678"
 *     )
 * )
 *
 * Register form.
 */
class RegisterForm extends Model
{
    public $email;
    public $password;

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [['email', 'password'], 'required'],
            [['email', 'password'], 'string'],
            [['email', 'password'], 'trim'],
            [['email'], 'email'],
            [['email'], 'filter', 'filter' => 'strtolower'],
            ['email','unique','targetClass' => User::class,'targetAttribute' => 'email']
        ];
    }
}
