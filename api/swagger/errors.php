<?php

namespace api\swagger;

/**
 * @OA\Schema(
 *      schema="FieldWithError",
 *      required={"code", "message"},
 *      @OA\Property(
 *          property="field",
 *          type="string",
 *          example="password"
 *      ),
 *     @OA\Property(
 *          property="message",
 *          type="string",
 *          example="Password cannot be blank."
 *      )
 * )
 *
 * @OA\Schema(
 *      schema="NotValid",
 *      required={"code", "message"},
 *      @OA\Property(
 *          property="error",
 *          type="array",
 *          @OA\Items(ref="#/components/schemas/FieldWithError")
 *      )
 * )
 *
 * @OA\Schema(
 *      schema="NotFoundHttpException",
 *      required={"code", "message"},
 *      @OA\Property(
 *          property="code",
 *          type="integer",
 *          format="int32",
 *          example=404
 *      ),
 *      @OA\Property(
 *          property="message",
 *          type="string",
 *          example="The requested object does not exist."
 *      )
 * )
 *
 * @OA\Schema(
 *      schema="ServerErrorHttpException",
 *      required={"code", "message"},
 *      @OA\Property(
 *          property="code",
 *          type="integer",
 *          format="int32",
 *          example=500
 *      ),
 *      @OA\Property(
 *          property="message",
 *          type="string",
 *          example="Internal Server Error"
 *      )
 * )
 *
 * @OA\Schema(
 *      schema="UnauthorizedHttpException",
 *      required={"code", "message"},
 *      @OA\Property(
 *          property="code",
 *          type="integer",
 *          format="int32",
 *          example=401
 *      ),
 *      @OA\Property(
 *          property="message",
 *          type="string",
 *          example="Unauthorized"
 *      )
 * )
 */
