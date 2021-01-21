<?php

namespace app\openApi;

/**
 *  @OA\OpenApi(
 *     security={"http"},
 *     @OA\Info(
 *         version="1.0.0",
 *         title="Company book service",
 *         description="Company book API documentation",
 *         @OA\Contact(name = "Alexander Kulyk")
 *     ),
 * )
 *
 *
 * @OA\SecurityScheme(
 *   securityScheme="api_key",
 *   type="apiKey",
 *   in="query",
 *   name="access_token"
 * )
 */
/**
 * @OA\Schema(
 *   @OA\Xml(name="##default")
 * )
 */
class openapi
{
    /**
     * @OA\Property(format="int32", description = "code of result")
     *
     * @var int
     */
    public $code;
    /**
     * @OA\Property
     *
     * @var string
     */
    public $type;
    /**
     * @OA\Property
     *
     * @var string
     */
    public $message;
    /**
     * @OA\Property(format = "int64", enum = {1, 2})
     *
     * @var int
     */
    public $status;
}
