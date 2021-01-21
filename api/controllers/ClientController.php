<?php

declare(strict_types=1);

namespace api\controllers;

use api\components\filters\AccessControlFilter;
use api\components\Serializer;
use api\services\ClientService;
use Throwable;
use Yii;
use yii\base\InvalidConfigException;
use yii\base\Module;
use yii\helpers\ArrayHelper;
use yii\rest\Controller;
use yii\web\NotFoundHttpException;


class ClientController extends Controller
{
    /** @var array */
    public $serializer = [
        'class' => Serializer::class,
        'collectionEnvelope' => 'items',
    ];

    protected ClientService $clientService;


    /**
     * ClientController constructor.
     *
     * @param string $id
     * @param Module $module
     * @param ClientService $clientService
     * @param array $config
     */
    public function __construct(
        string $id,
        Module $module,
        ClientService $clientService,
        array $config = []
    ) {
        $this->clientService = $clientService;

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
                        'actions' => ['index','companies'],
                        'roles' => ['@'],
                        'allow' => true,
                    ],
                ],
            ],
        ];

        return ArrayHelper::merge(parent::behaviors(), $behaviors);
    }

    /**
     * @OA\Get(path="/client",
     *     tags={"client"},
     *     summary="Get list of clients",
     *     description="Get list of clients with companies",
     *     @OA\Parameter(
     *        name="Authorization",
     *        required=true,
     *        description="JWT token. See details: https://jwt.io",
     *        in="header",
     *        @OA\Schema(
     *          type = "string",
     *          default = "Bearer"
     *        )
     *     ),
     *     @OA\Parameter(
     *        name="company_id",
     *        required=false,
     *        description="If send only clients with provided company id will be get",
     *        in="query",
     *        @OA\Schema(
     *          type = "integer",
     *          default = 0
     *        )
     *     ),
     *     @OA\Response(
     *         response = 200,
     *         description = "Found"
     *
     *     ),
     *     @OA\Response(
     *         response = 401,
     *         description = "When invalid or empty token",
     *         @OA\JsonContent(ref="#/components/schemas/UnauthorizedHttpException")
     *     ),
     *     @OA\Response(
     *         response = 404,
     *         description = "When there is no requested entity",
     *         @OA\JsonContent(ref="#/components/schemas/NotFoundHttpException")
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
     *
     *
     * @throws InvalidConfigException
     * @throws NotFoundHttpException
     * @throws Throwable
     */
    public function actionIndex(int $company_id = 0)
    {

        $searchModel = $this->clientService->createSearchModel(['company_id'=> $company_id]);
        $dataProvider = $this->clientService->getDataProvider($searchModel,Yii::$app->request->queryParams);
        return $dataProvider;
    }

    /**
     * @OA\Get(path="/client/companies?client_id={client_id}",
     *     tags={"client"},
     *     summary="Get list of client companies",
     *     description="Get list of client companies by client id",
     *     @OA\Parameter(
     *        name="Authorization",
     *        required=true,
     *        description="JWT token. See details: https://jwt.io",
     *        in="header",
     *        @OA\Schema(
     *          type = "string",
     *          default = "Bearer"
     *        )
     *     ),
     *     @OA\Parameter(
     *        name="client_id",
     *        required=true,
     *        description="The id of the client",
     *        in="query",
     *        @OA\Schema(
     *          type = "integer"
     *
     *        )
     *     ),
     *     @OA\Response(
     *         response = 200,
     *         description = "Found"
     *
     *     ),
     *     @OA\Response(
     *         response = 401,
     *         description = "When invalid or empty token",
     *         @OA\JsonContent(ref="#/components/schemas/UnauthorizedHttpException")
     *     ),
     *     @OA\Response(
     *         response = 404,
     *         description = "When there is no requested entity",
     *         @OA\JsonContent(ref="#/components/schemas/NotFoundHttpException")
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
     *
     *
     * @param int $client_id
     * @return \common\models\Company[]
     */
    public function actionCompanies(int $client_id)
    {
        if(!$model = $this->clientService->getModel($client_id)){
            throw new NotFoundHttpException('Client not found');
        }
        return $model->companies;
    }
}
