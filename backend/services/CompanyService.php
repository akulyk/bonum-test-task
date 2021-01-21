<?php
declare(strict_types=1);

namespace backend\services;

use backend\models\Client;
use backend\models\search\CompanySearch;
use common\models\ClientCompany;
use backend\models\Company;
use yii\data\ActiveDataProvider;
use yii\db\Expression;
use yii\db\Query;

class CompanyService
{

    public function createModel($config = []): Company
    {
        return new Company($config);
    }

    public function createSearchModel($config = []): CompanySearch
    {
        return new CompanySearch($config);
    }

    public function getDataProvider(CompanySearch $model, $params = []): ActiveDataProvider
    {
        $query = Company::find();
        $dataProvider = new ActiveDataProvider(
            [
                'query' => $query,
            ]
        );
        if (!($model->load($params) && $model->validate())) {
            return $dataProvider;
        }
        $query->andFilterWhere([Company::tableName() . '.id' => $model->id]);
        $query->andFilterWhere(['like', 'title', $model->title]);

        if ($model->client) {
            $query->joinWith('clients');
            $query->andFilterWhere(['like', Client::tableName() . '.name', $model->client]);
        }

        return $dataProvider;
    }

    public function getModel($id): Company
    {
        return Company::findOne($id);
    }

    public function handleModelCreate(Company $model, $post = [])
    {
        if (!$model->load($post)) {
            return false;
        }

        if (!$model->validate()) {
            return false;
        }

        $transaction = \Yii::$app->db->beginTransaction();
        $rows = [];
        $columns = ['client_id', 'company_id'];
        try {
            $model->save(false);
            foreach ($model->clientIds as $clientId) {
                $rows[] = [$clientId, $model->id];
            }
            if (!empty($rows)) {
                \Yii::$app->db->createCommand()->batchInsert(ClientCompany::tableName(), $columns, $rows)->execute();
            }
            $transaction->commit();
            return true;
        } catch (\Exception $e) {
            \Yii::error($e->getMessage());
            $transaction->rollBack();
            return false;
        }
    }

    public function handleModelUpdate(Company $model, $post = [])
    {
        if (!$model->load($post)) {
            return false;
        }

        if (!$model->validate()) {
            return false;
        }
        $transaction = \Yii::$app->db->beginTransaction();
        $rows = [];
        $columns = ['client_id', 'company_id'];
        try {
            $model->save(false);
            ClientCompany::deleteAll(['company_id' => $model->id]);
            foreach ($model->clientIds as $clientId) {
                $rows[] = [$clientId, $model->id];
            }
            if (!empty($rows)) {
                \Yii::$app->db->createCommand()->batchInsert(ClientCompany::tableName(), $columns, $rows)->execute();
            }
            $transaction->commit();
            return true;
        } catch (\Exception $e) {
            \Yii::error($e->getMessage());
            $transaction->rollBack();
            return false;
        }
    }

    public function handleModelDelete(Company $model)
    {
        $transaction = \Yii::$app->db->beginTransaction();
        try {
            ClientCompany::deleteAll(['company_id' => $model->id]);
            $model->delete();
            $transaction->commit();
            return true;
        } catch (\Exception $e) {
            \Yii::error($e->getMessage());
            $transaction->rollBack();
            return false;
        }
    }

    public function getListForSelect2(string $q = null, int $id = 0): array
    {
        $out = ['results' => ['id' => '', 'text' => '']];
        if (!is_null($q)) {
            $query = new Query();
            $query->select(new Expression("c.id, c.title AS `text`"))
                ->from('company c')
                ->where(['like', 'c.title', $q])
                ->limit(20);

            $command = $query->createCommand();
            $data = $command->queryAll();
            $out['results'] = array_values($data);
        }
        elseif ($id > 0) {
            $company = Company::findOne($id);
            $out['results'] = ['id' => $id, 'text' => $company->title ?? ''];
        }
        return $out;
    }

}
