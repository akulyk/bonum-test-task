<?php
declare(strict_types=1);

namespace backend\services;

use backend\models\Client;
use backend\models\search\ClientSearch;
use common\models\ClientCompany;
use common\models\Company;
use yii\data\ActiveDataProvider;
use yii\db\Expression;
use yii\db\Query;

class ClientService
{

    public function createModel($config = []): Client
    {
        return new Client($config);
    }

    public function createSearchModel($config = []): ClientSearch
    {
        return new ClientSearch($config);
    }

    public function getDataProvider(ClientSearch $model, $params = [])
    {
        $query = Client::find();
        $dataProvider = new ActiveDataProvider(
            [
                'query' => $query,
            ]
        );
        if (!($model->load($params) && $model->validate())) {
            return $dataProvider;
        }
        $query->andFilterWhere([Client::tableName() . '.id' => $model->id]);
        $query->andFilterWhere(['like', 'name', $model->name]);
        if ($model->company) {
            $query->joinWith('companies');
            $query->andFilterWhere(['like', Company::tableName() . '.title', $model->company]);
        }
        return $dataProvider;
    }

    public function getModel($id): Client
    {
        return Client::findOne($id);
    }

    public function handleModelCreate(Client $model, $post = [])
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
            foreach ($model->companyIds as $companyId) {
                $rows[] = [$model->id, $companyId];
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

    public function handleModelUpdate(Client $model, $post = [])
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
            ClientCompany::deleteAll(['client_id' => $model->id]);
            foreach ($model->companyIds as $companyId) {
                $rows[] = [$model->id, $companyId];
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

    public function handleModelDelete(Client $model)
    {
        $transaction = \Yii::$app->db->beginTransaction();
        try {
            ClientCompany::deleteAll(['client_id' => $model->id]);
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
            $query->select(new Expression("c.id, c.name AS `text`"))
                ->from('client c')
                ->orWhere(['like', 'c.name', $q])
                ->limit(20);


            $command = $query->createCommand();
            $data = $command->cache(30)->queryAll();
            $out['results'] = array_values($data);
        } elseif ($id > 0) {
            $client = Client::findOne($id);
            $out['results'] = ['id' => $id, 'text' => $client->name ?? ''];
        }
        return $out;
    }

}
