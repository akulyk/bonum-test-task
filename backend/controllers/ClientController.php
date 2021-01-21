<?php declare(strict_types=1);

namespace backend\controllers;

use backend\helpers\ClientHelper;
use backend\models\Client;
use backend\modules\adminlte\widgets\Alert;
use backend\services\ClientService;
use Yii;
use yii\base\Module;
use yii\web\Controller;


class ClientController extends Controller
{
    protected ClientService $clientService;

    public function __construct($id, Module $module,
                                ClientService $clientService,
                                $config = [])
    {
        $this->clientService = $clientService;
        parent::__construct($id, $module, $config);
    }

    public function actionIndex()
    {
        $searchModel = $this->clientService->createSearchModel();
        $dataProvider = $this->clientService->getDataProvider($searchModel, Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView(int $id)
    {
        $model = $this->findModel($id);
        return $this->render('view', ['model' => $model]);
    }

    public function actionUpdate(int $id)
    {
        $model = $this->findModel($id);
        if ($this->clientService->handleModelUpdate($model, Yii::$app->request->post())) {
            Yii::$app->session->setFlash('success', 'Model updated!');
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('update', ['model' => $model]);
    }

    public function actionCreate()
    {
        $model = $this->clientService->createModel();
        if ($this->clientService->handleModelCreate($model, Yii::$app->request->post())) {
            Yii::$app->session->setFlash('success', 'Model created!');
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('create', ['model' => $model]);
    }

    public function actionDelete(int $id)
    {
        $model = $this->findModel($id);
        if ($this->clientService->handleModelDelete($model)) {
            Yii::$app->session->setFlash('warning', 'Model deleted!');
            return $this->redirect(['index']);
        }
        Yii::$app->session->setFlash('error', 'Model delete error!');
        return $this->redirect(['view', 'id' => $model->id]);
    }

    public function actionGetListForSelect2(string $q = null, int $id = 0)
    {
        return $this->asJson($this->clientService->getListForSelect2($q,$id));
    }

    protected function findModel(int $id): Client
    {
        return $this->clientService->getModel($id);
    }


}
