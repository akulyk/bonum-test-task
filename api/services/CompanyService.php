<?php

declare(strict_types=1);

namespace api\services;


use api\models\search\CompanySearch;
use api\models\Company;
use yii\data\ActiveDataProvider;

class CompanyService {

    public function createSearchModel(array $config = []): CompanySearch
    {
        return new CompanySearch($config);
    }

    public function getDataProvider(CompanySearch $model,$params = [])
    {
        $query = Company::find();
        $query->with('clients');
        $dataProvider = new ActiveDataProvider([
            'query' => $query,

        ]);

        return $dataProvider;
    }



}
