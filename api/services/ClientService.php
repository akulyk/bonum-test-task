<?php

declare(strict_types=1);

namespace api\services;


use api\models\Client;
use api\models\search\ClientSearch;
use api\models\Company;
use yii\data\ActiveDataProvider;

class ClientService {


    public function createSearchModel(array $config = []): ClientSearch
    {
        return new ClientSearch($config);
    }

    public function getDataProvider(ClientSearch $model,$params = [])
    {
        $query = Client::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,

        ]);
        if(!$model->company_id) {
            $query->with('companies');
        } else
        {
            $query->joinWith('companies');
            $query->andWhere([Company::tableName().'.id'=>$model->company_id]);
        }

        return $dataProvider;
    }

    public function getModel(int $id): ?Client
    {
        return Client::findOne($id);
    }



}
