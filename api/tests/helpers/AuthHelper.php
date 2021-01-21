<?php

declare(strict_types=1);

namespace api\tests\helpers;

use api\tests\ApiTester;

final class AuthHelper
{
    public const OLD_USER_TOKEN = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6IjNiMzZkYzcwLWRkODEtM2JiZi1iMTlkLWJiM2I4Mzc1NWE1ZSIsImVtYWlsIjoiYnJvZGVyaWNrMDlAeWFob28uY29tIn0.tQIoUdYKodHaotpSa8NfrscO_8yIuEBodHYnDro4PIg';
    public const USER_WITH_WRONG_TOKEN = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6ImI4NWY0M2MyLTM1MGUtMzBjMi04YjZjLWZkMGI2ZDlmZGFjNCIsImVtYWlsIjoiZGFycmlvbi5zY2h1cHBlQG5pdHpzY2hlLmNvbSIsImZpcnN0X25hbWUiOiJNYXh3ZWxsIiwibGFzdF9uYW1lIjoiR3JhaGFtIn0.JPFT-Mji9JJF9kNLt_CzjTOlRywiB5UBMzdikFCiNqw';
    public const USER_WITHOUT_ID_TOKEN = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6Imt1aG4uc2hhbm55QGhvdG1haWwuY29tIn0.N5JAKFHXOQZn6nYZQZsinnqu6Q0_faaXUWxdYkYFbxA';
    public const USER_WITHOUT_MANUALLY_INVALIDATED_TOKEN = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6IjU4ZTUzYWM1LTEwNWYtM2M4Ny1iOWU3LThiODU2YmVlZjU4MCIsImVtYWlsIjoiYmFyb24uc3BpbmthQGhlaWRlbnJlaWNoLmNvbSJ9.fQNr_IZEf6jXclKUDefhYoeKq7Rp7xh8b52W2h-iqmM';

    /**
     * @param ApiTester $I
     * @param string $token
     * @param string $contentType
     */
    public static function setHeaders(
        ApiTester $I,
        string $token,
        string $contentType = 'application/json'
    ): void {
        $I->haveHttpHeader('Authorization', 'Bearer ' . $token);
        $I->haveHttpHeader('content-type', $contentType);
    }

    /**
     * @param ApiTester $I
     * @param string $contentType
     */
    public static function setHeadersWithoutAuthorization(
        ApiTester $I,
        string $contentType = 'application/json'
    ): void {
        $I->haveHttpHeader('content-type', $contentType);
    }
}
