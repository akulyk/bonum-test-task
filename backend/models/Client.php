<?php
declare(strict_types=1);

namespace backend\models;


class Client extends \common\models\Client
{
    public array $companyIds = [];

    public function rules(): array
    {
        return [
            ['name', 'string'],
            ['companyIds', 'each', 'rule' => ['integer']]
        ];
    }

    public function afterFind()
    {
        parent::afterFind();
        if ($companies = $this->companies) {
            foreach ($companies as $company) {
                $this->companyIds[] = $company->id;
            }
        }
    }

    public function makeInitTextForSelect2CompanyIds(array $companyIds = []): ?array
    {
        $initCompanies = null;
        if (!empty($companyIds)) {
            $companies = Company::findAll(['id' => $companyIds]);
            $initCompanies = [];
            foreach ($companies as $company) {
                $initCompanies[$company->id] = $company->title;
            }
        }
        return $initCompanies;
    }

}
