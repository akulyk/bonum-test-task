<?php

declare(strict_types=1);

namespace api\controllers;

use api\components\filters\AccessControlFilter;
use api\components\Serializer;
use api\services\CompanyService;
use Throwable;
use Yii;
use yii\base\InvalidConfigException;
use yii\base\Module;
use yii\helpers\ArrayHelper;
use yii\rest\Controller;
use yii\web\NotFoundHttpException;

/**
 * class BookController.
 */
class CompanyController extends Controller
{
    /** @var array */
    public $serializer = [
        'class' => Serializer::class,
        'collectionEnvelope' => 'items',
    ];

    protected CompanyService $companyService;


    /**
     * SiteController constructor.
     *
     * @param string $id
     * @param Module $module
     * @param CompanyService $companyService
     * @param array $config
     */
    public function __construct(
        string $id,
        Module $module,
        CompanyService $companyService,
        array $config = []
    ) {
        $this->companyService = $companyService;

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
                        'actions' => ['index'],
                        'roles' => ['@'],
                        'allow' => true,
                    ],
                ],
            ],
        ];

        return ArrayHelper::merge(parent::behaviors(), $behaviors);
    }



    /**
     * @OA\Get(path="/company",
     *     tags={"company"},
     *     summary="Get list of companies",
     *     description="Get list of companies with clients",
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
     *     @OA\Response(
     *         response = 200,
     *         description = "Found",
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
    public function actionIndex()
    {
        $searchModel = $this->companyService->createSearchModel();
        $dataProvider = $this->companyService->getDataProvider($searchModel,Yii::$app->request->queryParams);
        return $dataProvider;
    }
}
