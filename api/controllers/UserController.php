<?php

declare(strict_types=1);

namespace api\controllers;

use api\components\filters\AccessControlFilter;
use api\components\Serializer;
use api\forms\auth\LoginForm;
use api\forms\auth\LoginResponseForm;
use api\forms\auth\RegisterForm;
use api\forms\auth\RegisterResponseForm;
use api\services\UserService;
use Yii;
use yii\base\Exception;
use yii\base\InvalidConfigException;
use yii\base\Module;
use yii\helpers\ArrayHelper;
use yii\rest\Controller;

/**
 * class UserController.
 */
class UserController extends Controller
{
    /** @var array */
    public $serializer = [
        'class' => Serializer::class,
        'collectionEnvelope' => 'items',
    ];

    protected UserService $userService;

    /**
     * SiteController constructor.
     *
     * @param string $id
     * @param Module $module
     * @param UserService $userService
     * @param array $config
     */
    public function __construct(string $id,
                                Module $module,
                                UserService $userService,
                                array $config = [])
    {
        $this->userService = $userService;
        parent::__construct($id, $module, $config);
    }

    /**
     * @return array
     */
    public function behaviors(): array
    {
        $behaviors = [
            'access' => [
                'class' => AccessControlFilter::class,
                'rules' => [
                    [
                        'actions' => ['register'],
                        'roles' => ['?'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['login'],
                        'roles' => ['?'],
                        'allow' => true,
                    ],
                ],
            ],
        ];

        return ArrayHelper::merge(parent::behaviors(), $behaviors);
    }

    /**
     * @OA\Post(path="/user/register",
     *     tags={"user"},
     *     summary="Sign up User and returns JWT",
     *     description="Sign up User and returns JWT",
     *     @OA\RequestBody(
     *        description="User fields",
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/RestRegisterForm")
     *     ),
     *     @OA\Response(
     *         response = 201,
     *         description = "Created",
     *         @OA\JsonContent(ref="#/components/schemas/RestRegisterResponse")
     *     ),
     *     @OA\Response(
     *         response = 422,
     *         description = "When validation failed",
     *         @OA\JsonContent(ref="#/components/schemas/NotValid")
     *     ),
     *     @OA\Response(
     *         response = 500,
     *         description = "When there was an exception",
     *         @OA\JsonContent(ref="#/components/schemas/ServerErrorHttpException")
     *     )
     * )
     *
     * @return RegisterResponseForm
     * @throws Exception
     */
    public function actionRegister(): RegisterResponseForm
    {
        $registerForm = new RegisterForm();
        $registerForm->load(Yii::$app->request->post(), '');
        $registerResponseForm = $this->userService->register($registerForm);
        if (! $registerResponseForm->hasErrors()) {
            Yii::$app->response->setStatusCode(201);
        }

        return $registerResponseForm;
    }

    /**
     * @OA\Post(path="/user/login",
     *     tags={"user"},
     *     summary="Logs in User and returns JWT",
     *     description="Logs in User and returns JWT",
     *     @OA\RequestBody(
     *        description="User fields",
     *        required=true,
     *        @OA\JsonContent(ref="#/components/schemas/RestLoginForm")
     *     ),
     *     @OA\Response(
     *         response = 200,
     *         description = "OK",
     *         @OA\JsonContent(ref="#/components/schemas/RestLoginResponse")
     *     ),
     *     @OA\Response(
     *         response = 422,
     *         description = "When validation failed",
     *         @OA\JsonContent(ref="#/components/schemas/NotValid")
     *     ),
     *     @OA\Response(
     *         response = 500,
     *         description = "When there was an exception",
     *         @OA\JsonContent(ref="#/components/schemas/ServerErrorHttpException")
     *     )
     * )
     *
     * @return LoginResponseForm
     * @throws InvalidConfigException
     */
    public function actionLogin(): LoginResponseForm
    {
        $loginForm = new LoginForm();
        $loginForm->load(Yii::$app->request->post(), '');

        return $this->userService->loginByForm($loginForm);
    }
}
