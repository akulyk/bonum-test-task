<?php declare(strict_types=1);

namespace backend\controllers;

use backend\helpers\CompanyHelper;
use backend\models\Company;
use backend\services\CompanyService;
use Yii;
use yii\base\Module;
use yii\web\Controller;


class CompanyController extends Controller
{
    protected CompanyService $companyService;

    public function __construct($id, Module $module,
                                CompanyService $companyService,
                                $config = [])
    {
        $this->companyService = $companyService;
        parent::__construct($id, $module, $config);
    }

    public function actionIndex()
    {
        $searchModel = $this->companyService->createSearchModel();
        $dataProvider = $this->companyService->getDataProvider($searchModel, Yii::$app->request->queryParams);
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
        if ($this->companyService->handleModelUpdate($model, Yii::$app->request->post())) {
            Yii::$app->session->setFlash('success', 'Model updated!');
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('update', ['model' => $model]);
    }

    public function actionCreate()
    {
        $model = $this->companyService->createModel();
        if ($this->companyService->handleModelCreate($model, Yii::$app->request->post())) {
            Yii::$app->session->setFlash('success', 'Model created!');
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('create', ['model' => $model]);
    }

    public function actionDelete(int $id)
    {
        $model = $this->findModel($id);
        if ($this->companyService->handleModelDelete($model)) {
            Yii::$app->session->setFlash('warning', 'Model deleted!');
            return $this->redirect(['index']);
        }
        Yii::$app->session->setFlash('error', 'Model delete error!');
        return $this->redirect(['view', 'id' => $model->id]);
    }

    public function actionGetListForSelect2(string $q = null, int $id = 0)
    {
        return $this->asJson($this->companyService->getListForSelect2($q,$id));
    }

    protected function findModel(int $id): Company
    {
        return $this->companyService->getModel($id);
    }


}
